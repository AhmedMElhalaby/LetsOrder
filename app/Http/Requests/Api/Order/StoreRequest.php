<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Food;
use App\Models\Order;
use App\Models\Media;
use App\Models\OrderFood;
use App\Models\OrderStatus;
use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed delivered_date
 * @property mixed code
 * @property mixed foods
 */
class StoreRequest extends ApiRequest
{
    use ResponseTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivered_date'=>'sometimes|date_format:Y-m-d H:i:s',
            'code'=>'sometimes|string',
            'foods'=>'required|array',
            'foods.*.food_id'=>'required|exists:foods,id',
            'foods.*.quantity'=>'required|numeric',
        ];
    }

    public function persist(): JsonResponse
    {
        $provider_id = null;
        $amount = 0;
        $discount = 0;
        foreach ($this->foods as $food){
            $Food = (new Food())->find($food['food_id']);
            if ($provider_id == null) {
                $provider_id = $Food->getUserId();
            }else{
                if ($provider_id != $Food->getUserId()) {
                    return $this->failJsonResponse([__('messages.you_cannot_add_foods_from_several_provider_at_the_same_time')]);
                }
            }
            $amount += ($Food->getPrice() * $food['quantity']);
        }
        if ($this->filled('code')) {
            $Coupon = (new Coupon())->where('user_id',$provider_id)->where('code',$this->code)->first();
            if (!$Coupon) {
                return $this->failJsonResponse([__('messages.coupon_not_found')]);
            }
            Functions::check_coupon($Coupon);
            $discount = $amount * $Coupon->getValue() /100;
        }
        $Object = new Order();
        $Object->setUserId(auth()->user()->getId());
        $Object->setProviderId($provider_id);
        $Object->setAmount($amount);
        $Object->setDiscountAmount($discount);
        $Object->setOrderDate(Carbon::today());
        if($this->filled('delivered_date')){
            $Object->setDeliveredDate(Carbon::parse($this->delivered_date));
        }
        $Object->save();
        $Object->refresh();
        foreach ($this->foods as $food){
            $OrderFood = new OrderFood();
            $OrderFood->setOrderId($Object->getId());
            $OrderFood->setFoodId($food['food_id']);
            $OrderFood->setQuantity($food['quantity']);
            $OrderFood->save();
        }
        if (isset($Coupon)) {
            $CouponHistory = new CouponHistory();
            $CouponHistory->setOrderId($Object->getId());
            $CouponHistory->setUserId(auth()->user()->getId());
            $CouponHistory->setCouponId($Coupon->getId());
            $CouponHistory->save();
        }
        OrderStatus::ChangeStatus($Object->getId(),Constant::ORDER_STATUSES['PendingApproval']);
        return $this->successJsonResponse([__('messages.created_successful')],new OrderResource($Object),'Order');
    }
}
