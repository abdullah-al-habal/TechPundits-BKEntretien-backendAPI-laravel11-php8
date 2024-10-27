<?php

declare(strict_types=1);

namespace App\DTOs\SiteSetting;

use App\Http\Requests\API\V1\SiteSetting\CreateSiteSettingRequest;

class SiteSettingDTO
{
    public function __construct(
        public readonly string $key,
        public readonly string $value,
        public readonly ?int $id = null,
    ) {}

    // public static function fromRequest(CreateSiteSettingRequest|UpdateSiteSettingRequest $request): self
    // {
    //     $validated = $request->validated();
    //     return new self(
    //         key: $validated['key'],
    //         value: $validated['value'],
    //         id: $request instanceof UpdateSiteSettingRequest ? $validated['id'] : null
    //     );
    // }

    /**
     * @param  array{key: string, value: string, id?: int}  $data
     */
    // public static function fromArray(array $data): self
    // {
    //     return new self(
    //         key: $data['key'],
    //         value: $data['value'],
    //         id: $data['id'] ?? null
    //     );
    // }

    /**
     * @return array{key: string, value: string, id?: int}
     */
    // public function toArray(): array
    // {
    //     $array = [
    //         'key' => $this->key,
    //         'value' => $this->value,
    //     ];

    //     if ($this->id !== null) {
    //         $array['id'] = $this->id;
    //     }

    //     return $array;
    // }
}
