<?php

namespace App\Http\Requests\Api\Food;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Food\FoodResource;
use App\Models\Food;
use App\Models\Media;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed category_id
 * @property mixed name
 * @property mixed description
 * @property mixed price
 * @property mixed size
 * @property mixed media
 */
class StoreRequest extends ApiRequest
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
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'description'=>'sometimes|max:255',
            'price'=>'required|numeric',
            'size'=>'required|string|max:255',
            'media'=>'required|array',
            'media.*'=>'required|mimes:jpeg,jpg,png'
        ];
    }

    public function persist(): JsonResponse
    {
        $Object = new Food();
        $Object->setUserId(auth()->user()->getId());
        $Object->setCategoryId($this->category_id);
        $Object->setName($this->name);
        $Object->setDescription($this->description);
        $Object->setPrice($this->price);
        $Object->setSize($this->size);
        $Object->save();
        $Object->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($Object->getId());
            $Media->setMediaType(Constant::MEDIA_TYPES['Food']);
            $Media->setFile($media);
            $Media->save();
        }
        return $this->successJsonResponse([__('messages.created_successful')],new FoodResource($Object),'Food');
    }
}
