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
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use App\Traits\ResponseTrait;

/**
 * @property mixed per_page
 * @property mixed q
 * @property mixed provider_type
 */
class ProviderRequest extends ApiRequest
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
            'provider_type'=>'required|in:'.Constant::USER_TYPE_RULES
        ];
    }

    public function persist()
    {
        $Objects = new User();
        $Objects = $Objects->where('type',Constant::USER_TYPE['Provider'])->where('provider_type',$this->provider_type);
        if ($this->filled('q')) {
            $Objects = $Objects->where('q','Like','%'.$this->q.'%');
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = ProviderResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Providers',$Objects);
    }
}
