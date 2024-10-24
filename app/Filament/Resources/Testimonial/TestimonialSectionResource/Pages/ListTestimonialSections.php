<?php

declare(strict_types=1);

namespace App\Filament\Resources\Testimonial\TestimonialSectionResource\Pages;

use App\Filament\Resources\Testimonial\TestimonialSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestimonialSections extends ListRecords
{
    protected static string $resource = TestimonialSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
