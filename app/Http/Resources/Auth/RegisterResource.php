<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
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
}
