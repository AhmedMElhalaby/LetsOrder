<?php

namespace App\Http\Resources\Api\Home;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Favourite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->getId();
        $Object['city_id'] = $this->getCityId();
        $Object['City'] = new CityResource($this->city);
        $Object['name'] = $this->getName();
        $Object['mobile'] = $this->getMobile();
        $Object['email'] = $this->getEmail();
        $Object['avatar'] = $this->getAvatar();
        $Object['lat'] = $this->getLat();
        $Object['lng'] = $this->getLng();
        $Object['bio'] = $this->getBio();
        $Object['open_time'] = $this->getOpenTime();
        $Object['close_time'] = $this->getCloseTime();
        $Object['rate'] = $this->review()->avg('rate')??0;
        if($this->getOpenTime() &&$this->getCloseTime()){
            $startTime = Carbon::parse($this->getOpenTime())->format('H:i');
            $endTime = Carbon::parse($this->getCloseTime())->format('H:i');
            $currentTime = Carbon::now();
            if($currentTime->between($startTime, $endTime, true)){
                $Object['is_open'] = true;
            }else{
                $Object['is_open'] = false;
            }
        }else{
            $Object['is_open'] = false;
        }
        $Object['is_fav'] = Favourite::where('ref_id',$this->getId())->where('user_id',auth('api')->user()->getId())->where('type',Constant::FAVOURITE_TYPE['Provider'])->first()?true:false;
        $Object['distance'] = round(Functions::distance($this->getLat(),$this->getLng(),auth('api')->user()->getLat(),auth('api')->user()->getLng(),"K"),1);
        return $Object;
    }

}
