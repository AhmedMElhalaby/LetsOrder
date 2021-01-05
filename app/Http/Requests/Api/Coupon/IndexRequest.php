<?php

namespace App\Http\Requests\Api\Coupon;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Coupon\CouponResource;
use App\Models\Coupon;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed per_page
 */
class IndexRequest extends ApiRequest
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
            'per_page'=>'sometimes|numeric'
        ];
    }

    public function persist(): JsonResponse
    {
        $Objects = new Coupon();
        $Objects = $Objects->where('user_id',auth()->user()->getId());
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = CouponResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Coupons',$Objects);
    }
}
