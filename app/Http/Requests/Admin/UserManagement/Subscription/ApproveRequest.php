<?php

namespace App\Http\Requests\Admin\UserManagement\Subscription;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ApproveRequest extends FormRequest
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
        ];
    }
    public function preset($crud,$id){
        $Object = $crud->getEntity()->find($id);
        if(!$Object)
            return $crud->wrongData();
        $Object->setStatus(Constant::SUBSCRIPTION_STATUSES['Approved']);
        $Object->save();
        $Transaction = new Transaction();
        $Transaction->setUserId($Object->getUserId());
        $Transaction->setValue($Object->subscription->getGainedBalance());
        $Transaction->setRefId($Object->getId());
        $Transaction->setType(Constant::TRANSACTION_TYPES['Deposit']);
        $Transaction->setStatus(Constant::TRANSACTION_STATUS['Paid']);
        $Transaction->save();
        Functions::SendNotification($Object->user,'Subscription Approved','The Subscription has been approved','تم قبول اشتراكك',' تم قبول الاشتراك وتم تفعيله ',$Object->getId(),Constant::NOTIFICATION_TYPE['Subscription'],true);
        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
