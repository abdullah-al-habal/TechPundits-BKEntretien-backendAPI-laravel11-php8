<?php

declare(strict_types=1);

namespace App\Filament\Resources\Testimonial\TestimonialResource\Pages;

use App\Filament\Resources\Testimonial\TestimonialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestimonial extends CreateRecord
{
    protected static string $resource = TestimonialResource::class;
}
