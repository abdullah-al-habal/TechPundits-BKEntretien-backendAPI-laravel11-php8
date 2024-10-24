<?php

namespace App\Filament\Resources\Testimonial\TestimonialSectionResource\Pages;

use App\Filament\Resources\Testimonial\TestimonialSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestimonialSection extends EditRecord
{
    protected static string $resource = TestimonialSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
