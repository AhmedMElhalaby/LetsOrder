<?php

namespace App\Http\Requests\Api\Coupon;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Coupon\CouponResource;
use App\Models\Coupon;
use App\Models\Media;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed coupon_id
 * @property mixed code
 * @property mixed value
 * @property mixed max_use_times
 * @property mixed expire_at
 * @property mixed is_active
 */
class UpdateRequest extends ApiRequest
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
            'coupon_id'=>'required|exists:coupons,id',
            'code'=>'sometimes|string|max:255',
            'value'=>'sometimes|numeric|max:255',
            'max_use_times'=>'sometimes|numeric',
            'expire_at'=>'sometimes|date|max:255',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Coupon)->find($this->coupon_id);
        if($this->filled('code')){
            $Object->setCode($this->code);
        }
        if($this->filled('value')){
            $Object->setValue($this->value);
        }
        if($this->filled('max_use_times')){
            $Object->setMaxUseTimes($this->max_use_times);
        }
        if($this->filled('expire_at')){
            $Object->setExpireAt($this->expire_at);
        }
        $Object->save();
        $Object->refresh();
        return $this->successJsonResponse([__('messages.updated_successful')],new CouponResource($Object),'Coupon');
    }
}
