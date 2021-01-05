<?php

namespace App\Http\Resources\Api\Food;

use App\Http\Resources\Api\Home\UserResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
        $Objects['file'] = $this->getFile();
        return $Objects;
    }
}
