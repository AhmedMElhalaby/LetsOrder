<?php

namespace App\Http\Requests;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class VerifyPaymentRequest extends FormRequest
{

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
            'tap_id'=>'required',
        ];
    }

    public function persist()
    {
        $Object = (new Transaction)->where('payment_token',$this->tap_id)->first();
        $status = false;
        if($Object){
            $Response = Functions::CheckPayment(Constant::PAYMENT_METHOD['Tap'],$Object);
            if($Response){
                $status = true;
                $Object->setStatus(Constant::TRANSACTION_STATUS['Paid']);
                $Object->save();
            }
        }
        return view('verify_payment',compact('status'));
    }
}
