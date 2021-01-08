<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
        $Objects['id'] = $this->id;
        $Objects['provider_id'] = $this->provider_id;
        $Objects['image'] = $this->image;
        $Objects['url'] = $this->url;
        $Objects['type'] = $this->type;
        return $Objects;
    }
}
