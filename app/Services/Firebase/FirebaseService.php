<?php

declare(strict_types=1);

namespace App\Services\Firebase;

use GuzzleHttp\Client;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Messaging;
use Psr\Http\Message\StreamInterface;

class FirebaseService
{
    private readonly Messaging $messaging;

    public function __construct(
        private readonly Client $client,
        private readonly string $credentialsFile
    ) {
        $factory = (new Factory())->withServiceAccount($this->credentialsFile);
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification(
        string $title,
        string $body,
        string $token,
        string $platform = 'android'
    ): StreamInterface {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' => $title,
            'body' => $body,
        ];

        $data = [
            'to' => $token,
            'notification' => $notification,
        ];

        $this->addPlatformSpecificData($data, $platform);

        $headers = [
            'Authorization' => 'key=' . config('services.firebase.server_key'),
            'Content-Type' => 'application/json',
        ];

        $response = $this->client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);

        return $response->getBody();
    }

    public function getMessaging(): Messaging
    {
        return $this->messaging;
    }

    private function addPlatformSpecificData(array &$data, string $platform): void
    {
        match ($platform) {
            'ios' => $data['priority'] = 'high',
            'web' => $data['webpush'] = ['headers' => ['TTL' => '60']],
            default => null,
        };
    }
}
