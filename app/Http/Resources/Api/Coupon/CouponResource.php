<?php

namespace App\Http\Resources\Api\Coupon;

use App\Http\Resources\Api\Home\UserResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['user_id'] = $this->getUserId();
        $Objects['code'] = $this->getCode();
        $Objects['value'] = $this->getValue();
        $Objects['max_use_times'] = $this->getMaxUseTimes();
        $Objects['expire_at'] = $this->getExpireAt();
        $Objects['is_active'] = $this->isIsActive();
        return $Objects;
    }
}
