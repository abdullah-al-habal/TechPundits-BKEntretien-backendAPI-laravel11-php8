<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\Faq;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'question' => $this->question,
            'answer' => $this->answer,
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
