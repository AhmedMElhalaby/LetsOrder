<?php

namespace App\Http\Requests\Api\Food;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Food;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed food_id
 */
class DestroyRequest extends ApiRequest
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
            'food_id'=>'required|exists:foods,id',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Food)->find($this->food_id);
        try {
            $Object->delete();
            return $this->successJsonResponse([__('messages.deleted_successful')]);
        } catch (\Exception $e) {
            return $this->failJsonResponse([$e->getMessage()]);
        }
    }
}
