<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed name
 * @property mixed city_id
 * @property mixed mobile
 * @property mixed email
 * @property mixed lat
 * @property mixed lng
 * @property mixed bio
 * @property mixed open_time
 * @property mixed close_time
 * @property mixed app_locale
 * @property mixed device_token
 * @property mixed device_type
 */
class UserRequest extends ApiRequest
{
    use ResponseTrait;



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255,',
            'city_id' => 'exists:cities,id',
            'mobile' => 'numeric|min:6|unique:users,mobile,'. auth()->user()->id,
            'email' => 'email|unique:users,email,'. auth()->user()->id,
            'device_token' => 'string|required_with:device_type',
            'device_type' => 'string|required_with:device_token',
            'app_locale' => 'string|in:ar,en',

        ];
    }
    public function attributes()
    {
        return [];
    }
    public function persist()
    {
        $logged = auth()->user();
        if($this->hasFile('avatar')){
            $logged->setAvatar($this->file('avatar'));
        }
        if ($this->filled('name')){
            $logged->setName($this->name);
        }
        if ($this->filled('city_id')){
            $logged->setCityId($this->city_id);
        }
        if ($this->filled('mobile')){
            $logged->setMobile($this->mobile);
        }
        if ($this->filled('email')){
            $logged->setEmail($this->email);
        }
        if ($this->filled('lat')){
            $logged->setLat($this->lat);
        }
        if ($this->filled('lng')){
            $logged->setLng($this->lng);
        }
        if ($this->filled('bio')){
            $logged->setBio($this->bio);
        }
        if ($this->filled('open_time')){
            $logged->setOpenTime(Carbon::parse($this->open_time));
        }
        if ($this->filled('close_time')){
            $logged->setCloseTime(Carbon::parse($this->close_time));
        }
        if ($this->filled('app_locale')){
            $logged->setAppLocale($this->app_locale);
        }
        if ($this->filled('device_token')&&$this->filled('device_type')){
            $logged->setDeviceToken($this->device_token);
            $logged->setDeviceType($this->device_type);
        }
        $logged->save();
        DB::table('oauth_access_tokens')->where('user_id', $logged->id)->delete();
        $tokenResult = $logged->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        if ($logged->type == Constant::USER_TYPE['Customer']) {
            return $this->successJsonResponse( [__('auth.login')], new UserResource($logged,$tokenResult->accessToken),'User');
        }else{
            return $this->successJsonResponse( [__('auth.login')], new \App\Http\Resources\Api\User\ProviderResource($logged,$tokenResult->accessToken),'User');
        }
    }
}
