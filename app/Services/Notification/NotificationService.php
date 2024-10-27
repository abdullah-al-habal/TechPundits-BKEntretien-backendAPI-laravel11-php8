<?php

declare(strict_types=1);

namespace App\Services\Notification;

use App\Services\Firebase\FirebaseService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Notification;
use Psr\Http\Message\StreamInterface;

class NotificationService
{
    public function __construct(
        private readonly FirebaseService $firebaseService
    ) {}

    public function sendNotification(
        string $title,
        string $body,
        string $token,
        string $platform = 'android'
    ): object {
        $response = $this->firebaseService->sendNotification($title, $body, $token, $platform);

        return $this->parseResponse($response);
    }

    public function send(string $token, string $title, string $content, array $data = []): bool
    {
        try {
            $message = $this->createMessage($token, $title, $content, $data);
            $this->firebaseService->getMessaging()->send($message);

            return true;
        } catch (Exception $e) {
            Log::error('FCM Notification Error: '.$e->getMessage());

            return false;
        }
    }

    public function sendMultiple(array|Collection $tokens, string $title, string $content, array $data = []): bool
    {
        try {
            $message = CloudMessage::new()
                ->withNotification(Notification::create($title, $content))
                ->withData($data);

            $this->firebaseService->getMessaging()->sendMulticast($message, $tokens);

            return true;
        } catch (Exception $e) {
            Log::error('FCM Multicast Notification Error: '.$e->getMessage());

            return false;
        }
    }

    protected function createMessage(string $token, string $title, string $content, array $data): Message
    {
        return CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create($title, $content))
            ->withData(array_merge($data, [
                'priority' => 'high',
                'android_channel_id' => 'high_importance_channel',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'sound' => 'default',
            ]));
    }

    private function parseResponse(StreamInterface $response): object
    {
        $content = $response->getContents();
        $result = json_decode($content, true);

        return (object) [
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Unknown response',
            'data' => $result['results'] ?? [],
        ];
    }
}
