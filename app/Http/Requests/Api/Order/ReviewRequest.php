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
use App\Models\Review;
use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed order_id
 * @property mixed rate
 * @property mixed note
 * @property mixed provider_rate
 * @property mixed provider_note
 */
class ReviewRequest extends ApiRequest
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
            'order_id'=>'required|exists:orders,id',
            'rate'=>'required|numeric',
            'note'=>'sometimes|string',
            'provider_rate'=>'sometimes|numeric',
            'provider_note'=>'sometimes|string',
            'foods_review'=>'sometimes|array',
            'foods_review.*.food_id'=>'required|exists:foods,id',
            'foods_review.*.rate'=>'required|numeric',
            'foods_review.*.note'=>'sometimes|string',
        ];
    }

    public function persist(): JsonResponse
    {
        $logged = auth()->user();
        $Object = (new Order())->find($this->order_id);
        $OrderReview = Review::where('user_id',$logged->getId())->where('ref_id',$Object->getId())->where('type',Constant::REVIEW_TYPE['Order'])->first();
        if(!$OrderReview){
            $OrderReview = new Review();
            $OrderReview->setUserId($logged->getId());
            $OrderReview->setRefId($Object->getId());
            $OrderReview->setType(Constant::REVIEW_TYPE['Order']);
        }
        $OrderReview->setRate($this->rate);
        $OrderReview->setNote(@$this->note);
        $OrderReview->save();
        if ($this->filled('provider_rate')) {
            $OrderReview = Review::where('user_id',$logged->getId())->where('ref_id',$Object->getProviderId())->where('type',Constant::REVIEW_TYPE['Provider'])->first();
            if(!$OrderReview){
                $OrderReview = new Review();
                $OrderReview->setUserId($logged->getId());
                $OrderReview->setRefId($Object->getProviderId());
                $OrderReview->setType(Constant::REVIEW_TYPE['Provider']);
            }
            $OrderReview->setRate($this->provider_rate);
            $OrderReview->setNote(@$this->provider_note);
            $OrderReview->save();
        }
        foreach ($this->foods_review as $foods_review){
            $OrderReview = Review::where('user_id',$logged->getId())->where('ref_id',$foods_review['food_id'])->where('type',Constant::REVIEW_TYPE['Provider'])->first();
            if(!$OrderReview){
                $OrderReview = new Review();
                $OrderReview->setUserId($logged->getId());
                $OrderReview->setRefId($foods_review['food_id']);
                $OrderReview->setType(Constant::REVIEW_TYPE['Food']);
            }
            $OrderReview->setRate($foods_review['rate']);
            $OrderReview->setNote(@$foods_review['note']);
            $OrderReview->save();
        }
        return $this->successJsonResponse([__('messages.saved_successfully')],new OrderResource($Object),'Order');
    }
}
