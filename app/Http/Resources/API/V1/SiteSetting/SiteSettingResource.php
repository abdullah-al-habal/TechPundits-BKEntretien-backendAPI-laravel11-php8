<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\SiteSetting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->key => $this->value,
        ];
    }
}
