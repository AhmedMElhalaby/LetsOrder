<?php

namespace App\Http\Controllers\Admin\AppContent;

use App\Helpers\Constant;
use App\Http\Controllers\Admin\Controller;
use App\Models\Advertisement;
use App\Models\City;
use App\Models\User;
use App\Traits\AhmedPanelTrait;

class AdvertisementController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('app_content/advertisements');
        $this->setEntity(new Advertisement());
        $this->setTable('Advertisements');
        $this->setLang('Advertisement');
        $this->setColumns([
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
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_searchable'=>true,
                'order'=>true
            ],
            'type'=> [
                'name'=>'type',
                'type'=>'select',
                'data'=>[
                    Constant::ADVERTISEMENT_TYPE['Inside'] =>__('crud.Advertisement.Types.'.Constant::ADVERTISEMENT_TYPE['Inside'],[],session('my_locale')),
                    Constant::ADVERTISEMENT_TYPE['Outside'] =>__('crud.Advertisement.Types.'.Constant::ADVERTISEMENT_TYPE['Outside'],[],session('my_locale')),
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
                'custom_rule'=>'required_if:type,'.Constant::ADVERTISEMENT_TYPE['Inside'],
                'is_required'=>false
            ],
            'type'=> [
                'name'=>'type',
                'type'=>'select',
                'data'=>[
                    Constant::ADVERTISEMENT_TYPE['Inside'] =>__('crud.Advertisement.Types.'.Constant::ADVERTISEMENT_TYPE['Inside'],[],session('my_locale')),
                    Constant::ADVERTISEMENT_TYPE['Outside'] =>__('crud.Advertisement.Types.'.Constant::ADVERTISEMENT_TYPE['Outside'],[],session('my_locale')),
                ],
                'is_required'=>true
            ],
            'image'=> [
                'name'=>'image',
                'type'=>'image',
                'is_required'=>true,
                'is_required_update'=>false,
            ],
            'url'=> [
                'name'=>'url',
                'type'=>'url',
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
