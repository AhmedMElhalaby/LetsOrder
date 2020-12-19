<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionResource extends JsonResource
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
        $Objects['id'] = $this->subscription->id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->subscription->getNameAr():$this->subscription->getName();
        $Objects['description'] = (app()->getLocale() == 'ar')?$this->subscription->getDescriptionAr():$this->subscription->getDescription();
        $Objects['price'] = $this->subscription->getPrice();
        $Objects['gained_balance'] = $this->subscription->getGainedBalance();
        return $Objects;
    }
}
