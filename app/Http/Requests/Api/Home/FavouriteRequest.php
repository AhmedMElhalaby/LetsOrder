<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Food\FoodResource;
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
 * @property mixed per_page
 */
class FavouriteRequest extends ApiRequest
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
            'per_page'=>'sometimes|numeric'
        ];
    }

    public function persist()
    {
        $Favourites = (new Favourite())->where('user_id',auth()->user()->getId())->where('type',$this->type)->pluck('ref_id');
        if ($this->type == Constant::FAVOURITE_TYPE['Provider']) {
            $Providers = ProviderResource::collection((new User())->whereIn('id',$Favourites)->paginate($this->filled('per_page')?$this->per_page:10));
            return $this->successJsonResponse([],$Providers->items(),'Providers',$Providers);
        }else{
            $Foods = FoodResource::collection((new Food())->whereIn('id',$Favourites)->paginate($this->filled('per_page')?$this->per_page:10));
            return $this->successJsonResponse([],$Foods->items(),'Foods',$Foods);
        }
    }
}
