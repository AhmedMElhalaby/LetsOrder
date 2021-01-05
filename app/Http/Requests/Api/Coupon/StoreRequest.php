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
 * @property mixed code
 * @property mixed value
 * @property mixed max_use_times
 * @property mixed expire_at
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
            'code'=>'required|string|max:255',
            'value'=>'required|numeric|max:255',
            'max_use_times'=>'required|numeric',
            'expire_at'=>'required|date|max:255',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = new Coupon();
        $Object->setUserId(auth()->user()->getId());
        $Object->setCode($this->code);
        $Object->setValue($this->value);
        $Object->setMaxUseTimes($this->max_use_times);
        $Object->setExpireAt($this->expire_at);
        $Object->save();
        $Object->refresh();
        return $this->successJsonResponse([__('messages.created_successful')],new CouponResource($Object),'Coupon');
    }
}
