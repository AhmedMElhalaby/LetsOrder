<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\VerifyAccounts;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;

class VerifyForm extends ApiRequest
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
            'code' => 'required|string',
            'type'=>'required|in:'.Constant::VERIFICATION_TYPE_RULES

        ];
    }
    public function attributes()
    {
        return [];
    }
    public function persist()
    {
        $logged = auth('api')->user();
        $verify = VerifyAccounts::where('user_id',$logged->id)->where('type',$this->type)->first();
        if($this->code != $verify->code)
            return $this->failJsonResponse([__('auth.failed')]);
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']){
            if($logged->mobile_verified_at != null)
                return $this->failJsonResponse([__('auth.mobile_verified_before')]);
            else
                $logged->mobile_verified_at = now();
        }else{
            if($logged->email_verified_at != null)
                return $this->failJsonResponse([__('auth.verified_before')]);
            else
                $logged->email_verified_at = now();
        }
        $logged->save();
        DB::table('oauth_access_tokens')->where('user_id', $logged->id)->delete();
        $tokenResult = $logged->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return $this->successJsonResponse( [__('auth.verified')],new UserResource($logged,$tokenResult->accessToken),'User');
    }
}
