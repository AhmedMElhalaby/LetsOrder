<?php

namespace App\Http\Resources\Api\Order;

use App\Http\Resources\Api\Food\FoodResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderFoodResource extends JsonResource
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
        $Objects['Food'] = new FoodResource($this->food);
        $Objects['quantity'] = $this->getQuantity();
        return $Objects;
    }
}
