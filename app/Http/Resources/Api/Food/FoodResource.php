<?php

namespace App\Http\Resources\Api\Food;

use App\Http\Resources\Api\Home\UserResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
        $Objects['category_id'] = $this->getCategoryId();
        $Objects['Category'] = new Category($this->category);
        $Objects['name'] = $this->getName();
        $Objects['description'] = $this->getDescription();
        $Objects['price'] = $this->getPrice();
        $Objects['size'] = $this->getSize();
        $Objects['is_active'] = $this->isIsActive();
        $Objects['Media'] = MediaResource::collection($this->media);
        return $Objects;
    }
}
