<?php

namespace App\Http\Requests\Admin\UserManagement\Subscription;

use App\Helpers\Constant;
use App\Helpers\Functions;
use Illuminate\Foundation\Http\FormRequest;

class RejectRequest extends FormRequest
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
        $Object->setStatus(Constant::SUBSCRIPTION_STATUSES['Rejected']);
        $Object->save();
            Functions::SendNotification($Object->user,'Subscription Rejected','The Subscription has been rejected','تم رفض اشتراكك',' تم رفض الاشتراك  ',$Object->getId(),Constant::NOTIFICATION_TYPE['Subscription'],true);

        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
