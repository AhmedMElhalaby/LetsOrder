<?php

namespace App\Http\Requests\Admin\UserManagement\Subscription;

use App\Helpers\Constant;
use Illuminate\Foundation\Http\FormRequest;

class CancelRequest extends FormRequest
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
        $Object->setStatus(Constant::SUBSCRIPTION_STATUSES['Canceled']);
        $Object->save();
        return redirect($crud->getRedirect())->with('status', __('admin.messages.saved_successfully'));
    }
}
