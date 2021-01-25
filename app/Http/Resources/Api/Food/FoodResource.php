<?php

namespace App\Http\Resources\Api\Food;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Models\Favourite;
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
        $Objects['Category'] = new CategoryResource($this->category);
        $Objects['name'] = $this->getName();
        $Objects['description'] = $this->getDescription();
        $Objects['price'] = $this->getPrice();
        $Objects['size'] = $this->getSize();
        $Objects['is_active'] = $this->isIsActive();
        $Objects['rate'] = $this->review()->avg('rate')??0;
        $Objects['is_fav'] = Favourite::where('ref_id',$this->getId())->where('user_id',auth('api')->user()->getId())->where('type',Constant::FAVOURITE_TYPE['Food'])->first()?true:false;
        $Objects['Media'] = MediaResource::collection($this->media);
        return $Objects;
    }
}
