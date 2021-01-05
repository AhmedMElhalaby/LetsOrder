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
 * @property mixed food_id
 * @property mixed category_id
 * @property mixed name
 * @property mixed description
 * @property mixed price
 * @property mixed size
 * @property mixed media
 */
class UpdateRequest extends ApiRequest
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
            'category_id'=>'sometimes|exists:categories,id',
            'name'=>'sometimes|string|max:255',
            'description'=>'sometimes|max:255',
            'price'=>'sometimes|numeric',
            'size'=>'sometimes|string|max:255',
            'media'=>'sometimes|array',
            'media.*'=>'mimes:jpeg,jpg,png'

        ];
    }

    public function persist(): JsonResponse
    {
        $Object = (new Food)->find($this->food_id);
        if($this->filled('category_id')){
            $Object->setCategoryId($this->category_id);
        }
        if($this->filled('name')){
            $Object->setName($this->name);
        }
        if($this->filled('description')){
            $Object->setDescription($this->description);
        }
        if($this->filled('price')){
            $Object->setPrice($this->price);
        }
        if($this->filled('size')){
            $Object->setSize($this->size);
        }
        $Object->save();
        $Object->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($Object->getId());
            $Media->setMediaType(Constant::MEDIA_TYPES['Food']);
            $Media->setFile($media);
            $Media->save();
        }
        return $this->successJsonResponse([__('messages.updated_successful')],new FoodResource($Object),'Food');
    }
}
