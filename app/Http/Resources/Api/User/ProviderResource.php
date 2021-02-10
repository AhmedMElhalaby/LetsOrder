<?php

namespace App\Http\Resources\Api\User;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Resources\Api\Home\CityResource;
use App\Http\Resources\Api\Home\UserSubscriptionResource;
use App\Models\Favourite;
use App\Models\Notification;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    protected $token;

    /**
     * ExportResource constructor.
     * @param $resource
     * @param array $token
     */
    public function __construct($resource, $token =null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->getId();
        $Object['name'] = $this->getName();
        $Object['mobile'] = $this->getMobile();
        $Object['city_id'] = $this->getCityId();
        $Object['City'] = new CityResource($this->city);
        $Object['email'] = $this->getEmail();
        $Object['mobile_verified_at'] = $this->getMobileVerifiedAt()?Carbon::parse($this->getMobileVerifiedAt())->format('Y-m-d'):null;
        $Object['email_verified_at'] = $this->getEmailVerifiedAt()?Carbon::parse($this->getEmailVerifiedAt())->format('Y-m-d'):null;
        $Object['avatar'] = ($this->getAvatar())?asset($this->getAvatar()):asset('logo.png');
        $Object['lat'] = $this->getLat();
        $Object['lng'] = $this->getLng();
        $Object['type'] = $this->type;
        $Object['provide_type'] = $this->provider_type;
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
        $Subscription = UserSubscription::where('user_id',$this->getId())->where('status',Constant::SUBSCRIPTION_STATUSES['Approved'])->get();
        $Object['is_subscribed'] = count($Subscription)>0;
        $Object['Subscriptions'] = ($Subscription)?UserSubscriptionResource::collection($Subscription):null;
        $Object['app_locale'] = $this->getAppLocale();
        $Object['notification_count'] = Notification::where('user_id',$this->getId())->where('read_at',null)->count();
        $Object['access_token'] = $this->token;
        $Object['token_type'] = 'Bearer';
        return $Object;
    }
}
