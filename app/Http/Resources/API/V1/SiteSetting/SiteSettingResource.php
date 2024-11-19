<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company_name' => $this->when($this->key === 'company_name', $this->value),
            'company_phone' => $this->when($this->key === 'company_phone', $this->value),
            'company_email' => $this->when($this->key === 'company_email', $this->value),
            'company_address' => $this->when($this->key === 'company_address', $this->value),
            'social_media_facebook' => $this->when($this->key === 'social_media_facebook', $this->value),
            'social_media_twitter' => $this->when($this->key === 'social_media_twitter', $this->value),
            'social_media_instagram' => $this->when($this->key === 'social_media_instagram', $this->value),
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
