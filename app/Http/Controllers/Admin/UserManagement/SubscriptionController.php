<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UserManagement\Subscription\ApproveRequest;
use App\Http\Requests\Admin\UserManagement\Subscription\CancelRequest;
use App\Http\Requests\Admin\UserManagement\Subscription\RejectRequest;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use App\Traits\AhmedPanelTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SubscriptionController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('user_managements/subscriptions');
        $this->setEntity(new UserSubscription());
        $this->setCreate(false);
        $this->setExport(false);
        $this->setTable('user_subscriptions');
        $this->setLang('UserSubscription');
        $this->setColumns([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::all(),
                    'custom'=>function($Object){
                        return $Object->name;
                    },
                    'entity'=>'user'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'subscription_id'=> [
                'name'=>'subscription_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> Subscription::all(),
                    'custom'=>function($Object){
                        return $Object->name;
                    },
                    'entity'=>'subscription'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'payment_method'=> [
                'name'=>'payment_method',
                'type'=>'select',
                'data'=>[
                    Constant::PAYMENT_METHOD['BankTransfer'] =>__('crud.UserSubscription.PaymentMethod.'.Constant::PAYMENT_METHOD['BankTransfer'],[],session('my_locale')),
                    Constant::PAYMENT_METHOD['Cash'] =>__('crud.UserSubscription.PaymentMethod.'.Constant::PAYMENT_METHOD['Cash'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'payment_detail'=> [
                'name'=>'payment_detail',
                'type'=>'file',
                'is_searchable'=>true,
                'order'=>true
            ],
            'status'=> [
                'name'=>'status',
                'type'=>'select',
                'data'=>[
                    Constant::SUBSCRIPTION_STATUSES['Pending'] =>__('crud.UserSubscription.Statuses.'.Constant::SUBSCRIPTION_STATUSES['Pending'],[],session('my_locale')),
                    Constant::SUBSCRIPTION_STATUSES['Approved'] =>__('crud.UserSubscription.Statuses.'.Constant::SUBSCRIPTION_STATUSES['Approved'],[],session('my_locale')),
                    Constant::SUBSCRIPTION_STATUSES['Rejected'] =>__('crud.UserSubscription.Statuses.'.Constant::SUBSCRIPTION_STATUSES['Rejected'],[],session('my_locale')),
                    Constant::SUBSCRIPTION_STATUSES['Canceled'] =>__('crud.UserSubscription.Statuses.'.Constant::SUBSCRIPTION_STATUSES['Canceled'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
            'approve'=>[
                'route'=>'approve',
                'icon'=>'fa-check-square',
                'lang'=>__('crud.UserSubscription.Links.approve'),
                'condition'=>function ($Object){
                    return ($Object->getStatus() == Constant::SUBSCRIPTION_STATUSES['Pending']);
                }
            ],
            'reject'=>[
                'route'=>'reject',
                'icon'=>'fa-window-close',
                'lang'=>__('crud.UserSubscription.Links.reject'),
                'condition'=>function ($Object){
                    return ($Object->getStatus() == Constant::SUBSCRIPTION_STATUSES['Pending']);
                }
            ],
            'cancel'=>[
                'route'=>'cancel',
                'icon'=>'fa-window-close',
                'lang'=>__('crud.UserSubscription.Links.cancel'),
                'condition'=>function ($Object){
                    return ($Object->getStatus() == Constant::SUBSCRIPTION_STATUSES['Approved']);
                }
            ],
        ]);
    }

    /**
     * @param ApproveRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function approve(ApproveRequest $request, $id){
        return $request->preset($this,$id);
    }

    /**
     * @param RejectRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function reject(RejectRequest $request, $id){
        return $request->preset($this,$id);
    }

    /**
     * @param CancelRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function cancel(CancelRequest $request, $id){
        return $request->preset($this,$id);
    }


}
