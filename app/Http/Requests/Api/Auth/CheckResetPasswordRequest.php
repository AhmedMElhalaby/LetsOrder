<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\PasswordReset;
use App\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckResetPasswordRequest extends ApiRequest
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
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string',
        ];
    }
    public function attributes()
    {
        return [];
    }
    public function persist()
    {
        $user = User::where('email',$this->email)->first();
        $passwordReset = PasswordReset::where('user_id',$user->getId())->first();
        if($passwordReset->code == $this->code){
            return $this->successJsonResponse( [__('auth.code_correct')]);
        }
        else{
            return $this->failJsonResponse( [__('auth.code_not_correct')]);
        }
    }
}
