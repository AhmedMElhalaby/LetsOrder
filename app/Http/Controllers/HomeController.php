<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\VerifyPaymentRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VerifyAccounts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function privacy(){
        return view('privacy');
    }

    public function verify_payment(Request $request){
        $status = false;
        if ($request->filled('tap_id')) {
            $Object = (new Transaction)->where('payment_token',$request->tap_id)->first();
            if($Object){
                $Response = Functions::CheckPayment(Constant::PAYMENT_METHOD['Tap'],$Object);
                if($Response){
                    $status = true;
                    $Object->setStatus(Constant::TRANSACTION_STATUS['Paid']);
                    $Object->save();
                }
            }
        }
        return view('verify_payment',compact('status'));
    }
    public function verify(Request $request){
        if($request->has('token')){
            $verify = VerifyAccounts::where('token',$request->token)->first();
            if($verify){
                $User = User::where('id',$verify->user_id)->first();
                if($User->email_verified_at == null){
                    $User->email_verified_at = now();
                    $User->save();
                    $message = 'Email Verified Successfully';
                }else
                    $message = 'Email Verified Before !';
            }else
                $message = 'Verification Token is invalid !';
        }else
            $message = 'Verification Token is required !';
        return view('verification',compact('message'));
    }
}
