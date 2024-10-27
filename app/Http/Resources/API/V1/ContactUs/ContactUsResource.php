<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property null|\Illuminate\Database\Eloquent\Collection $sections
 */
class ContactUsResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sections' => $this->when($this->relationLoaded('sections'), fn() => ContactUsSectionResource::collection($this->sections)),
        ];
    }

    /**
     * @return array<string, mixed>
     */
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
