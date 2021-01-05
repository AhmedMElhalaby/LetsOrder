<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coupon\DestroyRequest;
use App\Http\Requests\Api\Coupon\IndexRequest;
use App\Http\Requests\Api\Coupon\ShowRequest;
use App\Http\Requests\Api\Coupon\StoreRequest;
use App\Http\Requests\Api\Coupon\UpdateRequest;
use Illuminate\Http\JsonResponse;

class CouponController extends Controller
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
}
