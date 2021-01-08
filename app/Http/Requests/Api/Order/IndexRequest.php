<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed per_page
 * @property mixed is_finished
 */
class IndexRequest extends ApiRequest
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
            'is_finished'=>'sometimes|in:0,1',
            'per_page'=>'sometimes|numeric'
        ];
    }

    public function persist(): JsonResponse
    {
        $logged = auth()->user();
        $Objects = new Order();
        if($logged->getType() == Constant::USER_TYPE['Customer']){
            $Objects = $Objects->where('user_id',$logged->getId());
        }else{
            $Objects = $Objects->where('provider_id',$logged->getId());
        }
        if($this->filled('is_finished')){
            $Objects = $Objects->where('is_finished',$this->is_finished);
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = OrderResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Orders',$Objects);
    }
}
