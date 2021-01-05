<?php

namespace App\Http\Requests\Api\Food;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Food\FoodResource;
use App\Models\Food;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed user_id
 * @property mixed category_id
 * @property mixed per_page
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
            'user_id'=>'sometimes|exists:users,id',
            'category_id'=>'sometimes|exists:categories,id',
            'per_page'=>'sometimes|numeric'
        ];
    }

    public function persist(): JsonResponse
    {
        $Objects = new Food();
        if($this->filled('user_id')){
            $Objects = $Objects->where('user_id',$this->user_id);
            $Objects = $Objects->where('is_active',true);
        }else{
            $Objects = $Objects->where('user_id',auth()->user()->getId());
        }
        if($this->filled('category_id')){
            $Objects = $Objects->where('category_id',$this->category_id);
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = FoodResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Foods',$Objects);
    }
}
