<?php

declare(strict_types=1);

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="LoginResource",
 *     type="object",
 *
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         @OA\Property(
 *             property="user",
 *             type="object",
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string", format="email")
 *         ),
 *         @OA\Property(property="access_token", type="string"),
 *         @OA\Property(property="token_type", type="string")
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="version", type="string"),
 *         @OA\Property(property="api_version", type="string")
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
