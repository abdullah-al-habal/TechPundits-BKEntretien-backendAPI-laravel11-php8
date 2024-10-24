<?php

declare(strict_types=1);

namespace App\Filament\Resources\Testimonial\TestimonialSectionResource\Pages;

use App\Filament\Resources\Testimonial\TestimonialSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestimonialSection extends CreateRecord
{
    protected static string $resource = TestimonialSectionResource::class;
}
