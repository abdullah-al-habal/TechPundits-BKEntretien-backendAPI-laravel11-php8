<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\Request;

abstract class AbstractDTO
{
    /**
     * Constructor to initialize the DTO with data.
     *
     * @param  array<string, mixed>  $data
     */
    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    /**
     * Fill the DTO properties with the provided data.
     *
     * @param  array<string, mixed>  $data
     * @return $this
     */
    public function fill(array $data): self
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    /**
     * Factory method to create a DTO from a Request object.
     */
    abstract public static function fromRequest(Request $request): static;

    /**
     * Factory method to create a DTO from an array.
     *
     * @param  array<string, mixed>  $data
     */
    abstract public static function fromArray(array $data): static;

    /**
     * Convert the DTO to an array.
     *
     * @return array<string, mixed>
     */
    abstract public function toArray(): array;
}
