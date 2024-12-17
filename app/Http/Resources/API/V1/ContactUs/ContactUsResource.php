<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $banner_image
 * @property string $banner_image_alt_text
 * @property string $banner_image_text
 * @property string $main_image
 * @property string $main_image_alt_text
 * @property string $main_image_text
 * @property null|\Illuminate\Database\Eloquent\Collection $sections
 */
class ContactUsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'banner_image' => $this->getFullUrl($this->banner_image),
            'banner_image_alt_text' => $this->banner_image_alt_text,
            'banner_image_text' => $this->banner_image_text,
            'main_image' => $this->getFullUrl($this->main_image),
            'main_image_alt_text' => $this->main_image_alt_text,
            'first_description' => $this->first_description,
            'second_description' => $this->second_description,
            'sections' => $this->when($this->relationLoaded('sections'), fn(): AnonymousResourceCollection => ContactUsSectionResource::collection($this->sections)),
        ];
    }

    

    /**
     * Generate the full URL for the given path.
     *
     * @param string|null $path
     * @return string|null
     */
    private function getFullUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $appUrl = config('app.url', env('APP_URL', 'http://localhost'));

        return filter_var($path, FILTER_VALIDATE_URL) !== false
            ? $path
            : $appUrl . '/storage/' . ltrim($path, '/');
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
