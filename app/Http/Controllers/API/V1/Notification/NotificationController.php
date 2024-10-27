<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Notification;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Constants\ErrorMessages;
use App\Constants\SuccessMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\V1\Notification\SendNotificationRequest;
use App\Http\Requests\API\V1\Notification\UpdateDeviceTokenRequest;
use App\Models\User;
use App\Services\Notification\NotificationService;
use Exception;
use Illuminate\Http\JsonResponse;

class NotificationController extends BaseApiController
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {}

    public function send(SendNotificationRequest $request): JsonResponse
    {
        try {
            $result = $this->notificationService->sendNotification(
                title: $request->input('title'),
                body: $request->input('body'),
                token: $request->input('token'),
                platform: $request->input('platform', 'android')
            );

            return $result->success
                ? $this->successResponse(
                    ['message' => SuccessMessages::getMessage(SuccessCode::NOTIFICATION_SENT)],
                    SuccessMessages::getMessage(SuccessCode::NOTIFICATION_SENT),
                    HttpStatusCodesEnum::OK,
                    null,
                    SuccessCode::NOTIFICATION_SENT
                )
                : $this->errorResponse(
                    ErrorMessages::getMessage(ErrorCode::NOTIFICATION_SEND_FAILED),
                    HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
                    null,
                    ErrorCode::NOTIFICATION_SEND_FAILED
                );
        } catch (Exception $e) {
            return $this->errorResponse(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
                null,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateDeviceToken(UpdateDeviceTokenRequest $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = $request->user();

            // This will use the mutator to set the token
            $user->fcm_token = $request->fcm_token;
            $user->save();

            $formattedToken = $user->fcm_token;

            return $this->successResponse(
                [
                    'message' => SuccessMessages::getMessage(SuccessCode::DEVICE_TOKEN_UPDATED),
                    'fcm_token' => $formattedToken,
                ],
                SuccessMessages::getMessage(SuccessCode::DEVICE_TOKEN_UPDATED),
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::DEVICE_TOKEN_UPDATED
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                ErrorMessages::getMessage(ErrorCode::DEVICE_TOKEN_UPDATE_FAILED),
                HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
                null,
                ErrorCode::DEVICE_TOKEN_UPDATE_FAILED
            );
        }
    }
}
