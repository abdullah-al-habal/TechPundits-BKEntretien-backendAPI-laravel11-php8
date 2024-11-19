<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\HomePage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageSectionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->getFullUrl($this->image),
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
