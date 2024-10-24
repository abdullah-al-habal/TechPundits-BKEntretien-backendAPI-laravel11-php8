<?php

declare(strict_types=1);

namespace App\Filament\Resources\Testimonial\TestimonialResource\Pages;

use App\Filament\Resources\Testimonial\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
