<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed order_id
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
            'order_id'=>'required|exists:orders,id',
        ];
    }

    public function persist(): JsonResponse
    {
        return $this->successJsonResponse([],new OrderResource((new Order())->find($this->order_id)),'Order');
    }
}
