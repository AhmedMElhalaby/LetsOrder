<?php

namespace App\Http\Requests\Api\Food;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Food\FoodResource;
use App\Models\Food;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed food_id
 */
class ShowRequest extends ApiRequest
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
            'food_id'=>'sometimes|exists:foods,id',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Food())->find($this->food_id);
        $Object = new FoodResource($Object);
        return $this->successJsonResponse([],$Object,'Food',$Object);
    }
}
