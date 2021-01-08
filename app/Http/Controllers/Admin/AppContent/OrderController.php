<?php

namespace App\Http\Controllers\Admin\AppContent;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Models\Order;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class OrderController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('app_content/orders');
        $this->setEntity(new Order());
        $this->setTable('orders');
        $this->setLang('Order');
        $this->setCreate(false);
        $this->setColumns([
            'user_id'=> [
                'name'=>'user_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::where('type',Constant::USER_TYPE['Customer'])->get(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->name:'';
                    },
                    'entity'=>'provider'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'provider_id'=> [
                'name'=>'provider_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> User::where('type',Constant::USER_TYPE['Provider'])->get(),
                    'custom'=>function($Object){
                        return ($Object)?$Object->name:'';
                    },
                    'entity'=>'provider'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'order_date'=> [
                'name'=>'order_date',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'status'=> [
                'name'=>'status',
                'type'=>'select',
                'data'=>[
                    Constant::ORDER_STATUSES['PendingApproval'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['PendingApproval'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Approved'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Approved'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Rejected'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Rejected'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Canceled'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Canceled'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['Finished'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['Finished'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['NotReceived'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['NotReceived'],[],session('my_locale')),
                    Constant::ORDER_STATUSES['NotDelivered'] =>__('crud.Order.Statuses.'.Constant::ORDER_STATUSES['NotDelivered'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->SetLinks([
//            'edit',
        ]);
    }

}
