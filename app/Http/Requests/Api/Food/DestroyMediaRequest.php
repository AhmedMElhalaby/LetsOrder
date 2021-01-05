<?php

namespace App\Http\Requests\Api\Food;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Food;
use App\Models\Media;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed media_id
 */
class DestroyMediaRequest extends ApiRequest
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
            'media_id'=>'required|exists:media,id',
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Media())->find($this->media_id);
        try {
            $Object->delete();
            return $this->successJsonResponse([__('messages.deleted_successful')]);
        } catch (\Exception $e) {
            return $this->failJsonResponse([$e->getMessage()]);
        }
    }
}
