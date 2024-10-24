<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\DrainCleaning;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrainCleaningSectionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
