<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\FaqResource;
use App\Http\Resources\Api\Home\ProviderResource;
use App\Http\Resources\Api\Home\SubscriptionResource;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Favourite;
use App\Models\Food;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use App\Traits\ResponseTrait;

/**
 * @property mixed type
 * @property mixed ref_id
 */
class FavouriteToggleRequest extends ApiRequest
{
    use ResponseTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'=>'required|in:'.Constant::FAVOURITE_TYPE_RULES,
            'ref_id'=>'required'
        ];
    }

    public function persist()
    {
        $Object = (new Favourite())->where('user_id',auth()->user()->getId())->where('type',$this->type)->where('ref_id',$this->ref_id)->first();
        if ($Object) {
            $Object->delete();
        }else{
            if($this->type == Constant::FAVOURITE_TYPE['Provider'] && !((new User)->find($this->ref_id))){
                return $this->successJsonResponse([__('messages.object_not_found')]);
            }
            if($this->type == Constant::FAVOURITE_TYPE['Food'] && !((new Food())->find($this->ref_id))){
                return $this->successJsonResponse([__('messages.object_not_found')]);
            }
            $Object = new Favourite();
            $Object->setUserId(auth()->user()->getId());
            $Object->setType($this->type);
            $Object->setRefId($this->ref_id);
            $Object->save();
        }
        return $this->successJsonResponse([__('messages.saved_successfully')]);
    }
}
