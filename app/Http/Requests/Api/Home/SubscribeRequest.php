<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Models\UserSubscription;
use App\Traits\ResponseTrait;

/**
 * @property mixed subscription_id
 */
class SubscribeRequest extends ApiRequest
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
            'subscription_id'=>'required|exists:subscriptions,id',
            'payment_detail'=>'required_if:payment_method,'.Constant::PAYMENT_METHOD['BankTransfer'].'|mimes:jpeg,jpg,png',
            'payment_method'=>'required|in:'.Constant::PAYMENT_METHOD_RULES
        ];
    }

    public function persist()
    {
        $logged = auth()->user();
        $Subscription = UserSubscription::where('user_id',$logged->getId())->where('status',Constant::SUBSCRIPTION_STATUSES['Pending'])->first();
        if($Subscription){
            return $this->failJsonResponse([__('messages.you_cannot_do_it_at_this_time')]);
        }
        $Object =new  UserSubscription();
        $Object->setUserId($logged->getId());
        $Object->setSubscriptionId($this->subscription_id);
        $Object->setPaymentMethod($this->payment_method);
        if ($this->payment_method == Constant::PAYMENT_METHOD['BankTransfer']){
            $Object->setPaymentDetail($this->file('payment_detail'));
        }
        $Object->save();
        return $this->successJsonResponse([__('messages.saved_successfully')]);
    }
}
