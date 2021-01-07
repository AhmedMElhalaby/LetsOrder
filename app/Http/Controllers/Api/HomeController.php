<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\SendNotificationRequest;
use App\Http\Requests\Api\Home\InstallRequest;
use App\Http\Requests\Api\Home\ProviderRequest;
use App\Http\Requests\Api\Home\SubscribeRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ResponseTrait;

    /**
     * @param ProviderRequest $request
     * @return JsonResponse
     */
    public function providers(ProviderRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param InstallRequest $request
     * @return JsonResponse
     */
    public function install(InstallRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param SubscribeRequest $request
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request): JsonResponse
    {
        return $request->persist();
    }
    /**
     * @param SendNotificationRequest $request
     * @return JsonResponse
     */
    public function send_notification(SendNotificationRequest $request): JsonResponse
    {
        return $request->persist();
    }
}
