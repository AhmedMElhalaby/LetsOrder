<?php


namespace App\Helpers;

use App\Models\CouponHistory;
use App\Models\Notification;
use App\Models\PasswordReset;
use App\Models\Transaction;
use App\Models\VerifyAccounts;
use App\Notifications\PasswordReset as PasswordResetNotification;
use App\Notifications\VerifyAccount;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Functions
{
    use ResponseTrait;
    public static function SendNotification($user,$title,$msg,$title_ar,$msg_ar,$ref_id = null,$type= 0,$store = true,$replace =[])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $user->device_token;

        $message = array
        (
            'body'  => ($user->getAppLocale() == 'en')?$msg:$msg_ar,
            'title' => ($user->getAppLocale() == 'en')?$title:$title_ar,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" =>$ref_id,"type"=>$type];
        $fields = array
        (
            'to'        => $registrationIds,
            'notification'  => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key='.config('app.notification_key') ,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if($store){
            $notify = new Notification();
            $notify->setType($type);
            $notify->setUserId($user->id);
            $notify->setTitle($title);
            $notify->setMessage($msg);
            $notify->setTitleAr($title_ar);
            $notify->setMessageAr($msg_ar);
            $notify->setRefId(@$ref_id);
            $notify->save();
        }
        return true;
    }
    public static function SendNotifications($users,$title,$msg,$ref_id = null,$type= 0,$store = true,$replace =[])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = [];
        foreach ($users as $user){
            $registrationIds[] = $user->device_token;

        }

        $message = array
        (
            'body'  => $msg,
            'title' => $title,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" =>$ref_id,"type"=>$type];
        $fields = array
        (
            'registration_ids' => $registrationIds,
            'notification' => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key='.config('app.notification_key') ,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if($store){
            foreach ($users as $user){
                $notify = new Notification();
                $notify->setType($type);
                $notify->setUserId($user->id);
                $notify->setTitle($title);
                $notify->setMessage($msg);
                $notify->setTitleAr($title);
                $notify->setMessageAr($msg);
                $notify->setRefId(@$ref_id);
                $notify->save();
            }
        }
        return true;
    }
    public static function SendSms($msg,$to){
        $ch = curl_init();
        $userid = 'test';
        $password = 'test';
        $sender = 'test';
        $text = urlencode($msg);
        $encoding = 'UTF8';
        // auth call
        $url = "http://api.unifonic.com/wrapper/sendSMS.php?userid={$userid}&password={$password}&to={$to}&msg={$text}&sender={$sender}&encoding={$encoding}";
        $ret  = json_decode(file_get_contents($url), true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    public static function SendVerification($user,$type = null){
        if($type != null){
            switch ($type){
                case Constant::VERIFICATION_TYPE['Email']:{
                    if($user->getEmailVerifiedAt() != null)
                        return (new Functions)->failJsonResponse([__('auth.verified_before')]);
                    $code_email = rand( 10000 , 99999 );
                    $token = Str::random(40).time();
                    VerifyAccounts::updateOrCreate(
                        ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Email']],
                        [
                            'user_id' => $user->getId(),
                            'code' => $code_email,
                            'token' => $token,
                            'type'=>Constant::VERIFICATION_TYPE['Email']
                        ]
                    );
                    $user->notify(
                        new VerifyAccount($token,$code_email)
                    );
                    break;
                }
                case Constant::VERIFICATION_TYPE['Mobile']:{
                    if($user->getMobileVerifiedAt() != null)
                        return (new Functions)->failJsonResponse([__('auth.mobile_verified_before')]);
                    $code_mobile = rand( 10000 , 99999 );
                    $token = Str::random(40).time();
                    VerifyAccounts::updateOrCreate(
                        ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Mobile']],
                        [
                            'user_id' => $user->getId(),
                            'code' => $code_mobile,
                            'token' => $token,
                            'type'=>Constant::VERIFICATION_TYPE['Mobile']
                        ]
                    );
                    static::SendSms('كود تفعيل الحساب هو : '.$code_mobile,$user->getMobile());
                    break;
                }
            }
        }else{
            $code_email = rand( 10000 , 99999 );
            $code_mobile = rand( 10000 , 99999 );
            $token = Str::random(40).time();
            VerifyAccounts::updateOrCreate(
                ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Email']],
                [
                    'user_id' => $user->getId(),
                    'code' => $code_email,
                    'token' => $token,
                    'type'=>Constant::VERIFICATION_TYPE['Email']
                ]
            );
            VerifyAccounts::updateOrCreate(
                ['user_id' => $user->getId(),'type'=>Constant::VERIFICATION_TYPE['Mobile']],
                [
                    'user_id' => $user->getId(),
                    'code' => $code_mobile,
                    'token' => $token,
                    'type'=>Constant::VERIFICATION_TYPE['Mobile']
                ]
            );
            static::SendSms('كود تفعيل الحساب هو : '.$code_mobile,$user->getMobile());
            $user->notify(
                new VerifyAccount($token,$code_email)
            );
        }
        return (new Functions)->successJsonResponse( [__('auth.verification_code_sent')]);
    }
    public static function SendForget($user,$type = null){
        $code = rand( 10000 , 99999 );
        $token = Str::random(40).time();
        PasswordReset::updateOrCreate(
            ['user_id' => $user->getId()],
            [
                'user_id' => $user->getId(),
                'code' => $code,
                'token' => $token,
            ]
        );
        static::SendSms('كود استرجاع كلمة المرور هو : '.$code,$user->getMobile());
        $user->notify(
            new PasswordResetNotification($code)
        );
    }
    public static function StoreImage($attribute_name,$destination_path){
        $destination_path = "storage/".$destination_path.'/';
        $request = Request::instance();
        if ($request->hasFile($attribute_name)) {
            $file = $request->file($attribute_name);
            if ($file->isValid()) {
                $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
                $file->move($destination_path, $file_name);
                $attribute_value =  $destination_path.$file_name;
            }
        }
        return $attribute_value??null;
    }
    public static function StoreImageModel($file,$destination_path){
        $destination_path = "storage/".$destination_path.'/';
        if ($file->isValid()) {
            $file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move($destination_path, $file_name);
            $attribute_value =  $destination_path.$file_name;
        }
        return $attribute_value??null;
    }
    public static function UserBalance($user_id){
        $Deposits = Transaction::where('user_id',$user_id)->where('type',Constant::TRANSACTION_TYPES['Deposit'])->where('status',Constant::TRANSACTION_STATUS['Paid'])->sum('value');
        $Withdraws = Transaction::where('user_id',$user_id)->where('type',Constant::TRANSACTION_TYPES['Withdraw'])->where('status',Constant::TRANSACTION_STATUS['Paid'])->sum('value');
        $Holding = Transaction::where('user_id',$user_id)->where('type',Constant::TRANSACTION_TYPES['Holding'])->where('status',Constant::TRANSACTION_STATUS['Paid'])->sum('value');
        return $Deposits - $Withdraws - $Holding;
    }
    public static function CheckPayment($type,$Transaction){
        switch ($type){
            case Constant::PAYMENT_METHOD['Tap']:{
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.tap.company/v2/authorize/".$Transaction->getPaymentToken(),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "{}",
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer ".config('app.tap_sk')
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $response = json_decode($response);
                if ($err) {
                    echo false;
                } else {
                    if (@$response->status == 'AUTHORIZED'){
                        return true;
                    }else{
                        return false;
                    }
                }
                break;
            }
//            case Constant::PAYMENT_METHOD['Paypal']:{
//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/oauth2/token');
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                curl_setopt($ch, CURLOPT_POST, 1);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
//                curl_setopt($ch, CURLOPT_USERPWD, config('app.paypal_username') . ':' . config('app.paypal_secret'));
//                $headers = array();
//                $headers[] = 'Accept: application/json';
//                $headers[] = 'Accept-Language: en_US';
//                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
//                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                $result = curl_exec($ch);
//                if (curl_errno($ch)) {
//                    return false;
//                }
//                curl_close($ch);
//                $result = json_decode($result);
//                if (isset($result->access_token)){
//                    $curl = curl_init();
//                    curl_setopt_array($curl, array(
//                        CURLOPT_URL => "https://api.sandbox.paypal.com/v1/payments/payment/".$Transaction->getPaymentToken(),
//                        CURLOPT_RETURNTRANSFER => true,
//                        CURLOPT_ENCODING => "",
//                        CURLOPT_MAXREDIRS => 10,
//                        CURLOPT_TIMEOUT => 30,
//                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                        CURLOPT_CUSTOMREQUEST => "GET",
//                        CURLOPT_POSTFIELDS => "{}",
//                        CURLOPT_HTTPHEADER => array(
//                            "authorization: Bearer ".$result->access_token
//                        ),
//                    ));
//                    $response = curl_exec($curl);
//                    if (curl_errno($curl)) {
//                        return false;
//                    }
//                    curl_close($curl);
//                    $response = json_decode($response);
//                    if (isset($response->state) && $response->state == 'approved'){
//                        return true;
//                    }else{
//                        if(isset($response->transactions) && isset($response->payer) && isset($response->payer->payer_info) && isset($response->payer->payer_info->payer_id) ){
//                            $ch = curl_init();
//                            curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/payments/payment/'.$Transaction->getPaymentToken().'/execute');
//                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                            curl_setopt($ch, CURLOPT_POST, 1);
//                            $Object['payer_id'] =$response->payer->payer_info->payer_id;
//                            $Object['transactions'] =$response->transactions;
//                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Object));
//                            $headers = array();
//                            $headers[] = 'Content-Type: application/json';
//                            $headers[] = 'Authorization: Bearer '.$result->access_token;
//                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//                            $res = curl_exec($ch);
//                            if (curl_errno($ch)) {
//                                return false;
//                            }
//                            curl_close($ch);
//                            $res = json_decode($res);
//
//                            if (isset($res->state) && $res->state == 'approved'){
//                                return true;
//                            }
//                        }
//                    }
//                }
//                return false;
//                break;
//            }
        }
    }


    public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
    public static function check_coupon($Object){
        $CouponHistory = CouponHistory::where('coupon_id',$Object->getId())->where('user_id',auth()->user()->getId())->count();
        $coupon_date = Carbon::parse($Object->getExpireAt())->format('Y-m-d');
        if ($coupon_date >= Carbon::today()->format('Y-m-d')) {
            return __('messages.offer_expired');
        }
        if ($CouponHistory >= $Object->getMaxUseTimes()) {
            return __('messages.you_cannot_do_it_at_this_time');
        }
        return '';
    }
}
