<?php

namespace App\Http\Resources\API\V1\DrainCleaning;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrainCleaningResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
