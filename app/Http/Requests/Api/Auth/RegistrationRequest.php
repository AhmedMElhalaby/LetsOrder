<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Traits\ResponseTrait;
use App\Models\User;

/**
 * @property mixed name
 * @property mixed password
 * @property mixed mobile
 * @property mixed email
 * @property mixed dob
 * @property mixed type
 * @property mixed lat
 * @property mixed lng
 * @property mixed provider_type
 * @property mixed app_locale
 * @property mixed gender
 * @property mixed device_token
 * @property mixed device_type
 * @property mixed city_id
 */
class RegistrationRequest extends ApiRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'password' => 'required|string|min:6',
            'mobile' => 'required|numeric|unique:users',
            'email' => 'required|email|unique:users',
            'type'=>'required|in:'.Constant::USER_TYPE_RULES,
            'provider_type'=>'required_if:type,'.Constant::USER_TYPE['Provider'].'|in:'.Constant::PROVIDER_TYPE_RULES,
            'device_token' => 'string|required_with:device_type',
            'device_type' => 'string|required_with:device_token',
            'app_locale' => 'sometimes|in:en,ar',
        ];
    }
    public function attributes()
    {
        return [];
    }
    public function persist()
    {
        $user = new User();
        $user->setName($this->name);
        $user->setPassword($this->password);
        $user->setMobile($this->mobile);
        $user->setCityId($this->city_id);
        $user->setEmail($this->email);
        $user->setLat(@$this->lat);
        $user->setLng(@$this->lng);
        $user->setType($this->type);
        $user->setProviderType($this->provider_type);
        $user->setAppLocale($this->filled('app_locale')?$this->app_locale:'en');
        if ($this->filled('device_token') && $this->filled('device_type')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
        }
        $user->save();
         $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $user->refresh();
        try {
            Functions::SendVerification($user);
        }catch (\Exception $e){

        }
        return $this->successJsonResponse( [__('messages.saved_successfully')],new UserResource($user,$tokenResult->accessToken),'User');
    }

}
