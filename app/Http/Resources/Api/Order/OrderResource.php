<?php

namespace App\Http\Resources\Api\Order;

use App\Http\Resources\Api\Home\ProviderResource;
use App\Http\Resources\Api\Home\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        $Objects['User'] = new UserResource($this->user);
        $Objects['provider_id'] = $this->getProviderId();
        $Objects['Provider'] = new ProviderResource($this->provider);
        $Objects['amount'] = $this->getAmount();
        $Objects['discount_amount'] = $this->getDiscountAmount();
        $Objects['order_date'] = $this->getOrderDate();
        $Objects['delivered_date'] = $this->getDeliveredDate();
        $Objects['reject_reason'] = $this->getRejectReason();
        $Objects['cancel_reason'] = $this->getCancelReason();
        $Objects['is_finished'] = $this->isIsFinished();
        $Objects['rate'] = $this->review()->avg('rate');
        $Objects['status'] = $this->getStatus();
        $Objects['OrderFoods'] = OrderFoodResource::collection($this->order_foods);
        $Objects['OrderStatuses'] = OrderStatusResource::collection($this->order_statuses);
        return $Objects;
    }
}
