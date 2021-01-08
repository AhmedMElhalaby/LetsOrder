<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Coupon\CouponResource;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed code
 */
class CheckCouponRequest extends ApiRequest
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
            'code'=>'required|exists:coupons,code',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Coupon())->where('code',$this->code)->first();
        Functions::check_coupon($Object);
        return $this->successJsonResponse([],new CouponResource($Object),'Coupon');
    }
}
