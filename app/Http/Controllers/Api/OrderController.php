<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Http\Requests\Api\Order\ShowRequest;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use App\Http\Requests\Api\Order\CheckCouponRequest;
use App\Http\Requests\Api\Order\ReviewRequest;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
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
     * @param CheckCouponRequest $request
     * @return JsonResponse
     */
    public function check_coupon(CheckCouponRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param ReviewRequest $request
     * @return JsonResponse
     */
    public function review(ReviewRequest $request): JsonResponse
    {
        return $request->persist();
    }
}
