<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Food\DestroyMediaRequest;
use App\Http\Requests\Api\Food\DestroyRequest;
use App\Http\Requests\Api\Food\IndexRequest;
use App\Http\Requests\Api\Food\ShowRequest;
use App\Http\Requests\Api\Food\StoreRequest;
use App\Http\Requests\Api\Food\UpdateRequest;
use Illuminate\Http\JsonResponse;

class FoodController extends Controller
{
    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param DestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param DestroyMediaRequest $request
     * @return JsonResponse
     */
    public function destroy_media(DestroyMediaRequest $request): JsonResponse
    {
        return $request->persist();
    }
}
