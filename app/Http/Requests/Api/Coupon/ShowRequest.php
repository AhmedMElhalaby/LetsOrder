<?php

namespace App\Http\Requests\Api\Coupon;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Coupon\CouponResource;
use App\Models\Coupon;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed coupon_id
 */
class ShowRequest extends ApiRequest
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
            'coupon_id'=>'sometimes|exists:coupons,id',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Coupon())->find($this->coupon_id);
        $Object = new CouponResource($Object);
        return $this->successJsonResponse([],$Object,'Coupon',$Object);
    }
}
