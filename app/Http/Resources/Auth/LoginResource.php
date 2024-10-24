<?php

declare(strict_types=1);

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LoginResource",
 *     type="object",
 *     title="Contact Us Information",
 *     description="Details of contact us information",
 *
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="john@example.com"),
 *     @OA\Property(property="phone", type="string", example="(123) 456-7890"),
 *     @OA\Property(property="message", type="string", example="Hello, I have a question."),
 *     @OA\Property(property="meta", type="object",
 *         @OA\Property(property="version", type="string", example="1.0"),
 *         @OA\Property(property="api_version", type="string", example="v1")
 *     )
 * )
 */
class LoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'name' => $this['user']->name,
                'email' => $this['user']->email,
            ],
            'access_token' => $this['access_token'],
            'token_type' => $this['token_type'],
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'version' => config('app.version', '1.0'),
                'api_version' => 'v1',
            ],
        ];
    }
}
