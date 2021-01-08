<?php

namespace App\Http\Controllers\Admin\AppData;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Subscription;
use App\Traits\AhmedPanelTrait;

class SubscriptionController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('app_data/subscriptions');
        $this->setEntity(new Subscription());
        $this->setTable('subscriptions');
        $this->setLang('Subscription');
        $this->setColumns([
            'name'=> [
                'name'=>'name',
                'type'=>'text-custom',
                'custom'=>function ($Object){
                    return (session('my_locale') =='ar')?$Object->getNameAr():$Object->getName();
                },
                'is_searchable'=>true,
                'order'=>true
            ],
            'description'=> [
                'name'=>'description',
                'type'=>'text-custom',
                'custom'=>function ($Object){
                    return (session('my_locale') =='ar')?$Object->getDescriptionAr():$Object->getDescription();
                },
                'is_searchable'=>true,
                'order'=>true
            ],
            'price'=> [
                'name'=>'price',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'type'=> [
                'name'=>'type',
                'type'=>'select',
                'data'=>[
                    Constant::SUBSCRIPTION_TYPES['Monthly'] =>__('crud.Subscription.Types.'.Constant::ADVERTISEMENT_TYPE['Monthly'],[],session('my_locale')),
                    Constant::SUBSCRIPTION_TYPES['Quarterly'] =>__('crud.Subscription.Types.'.Constant::ADVERTISEMENT_TYPE['Quarterly'],[],session('my_locale')),
                    Constant::SUBSCRIPTION_TYPES['SemiAnnually'] =>__('crud.Subscription.Types.'.Constant::ADVERTISEMENT_TYPE['SemiAnnually'],[],session('my_locale')),
                    Constant::SUBSCRIPTION_TYPES['Annually'] =>__('crud.Subscription.Types.'.Constant::ADVERTISEMENT_TYPE['Annually'],[],session('my_locale')),
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'name'=> [
                'name'=>'name',
                'type'=>'text',
                'is_required'=>true
            ],
            'name_ar'=> [
                'name'=>'name_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'description'=> [
                'name'=>'description',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'description_ar'=> [
                'name'=>'description_ar',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'price'=> [
                'name'=>'price',
                'type'=>'text',
                'is_required'=>true
            ],
            'gained_balance'=> [
                'name'=>'gained_balance',
                'type'=>'number',
                'is_required'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }

}
