<?php

namespace App\Http\Requests\Api\Coupon;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Coupon;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed coupon_id
 */
class DestroyRequest extends ApiRequest
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
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Coupon)->find($this->coupon_id);
        try {
            $Object->delete();
            return $this->successJsonResponse([__('messages.deleted_successful')]);
        } catch (\Exception $e) {
            return $this->failJsonResponse([$e->getMessage()]);
        }
    }
}
