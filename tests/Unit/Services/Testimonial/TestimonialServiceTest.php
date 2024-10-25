<?php

declare(strict_types=1);

use App\Exceptions\API\V1\Testimonial\TestimonialNotFoundException;
use App\Models\Testimonial;
use App\Services\Testimonial\TestimonialService;

it('returns testimonials when they exist', static function (): void {
    Testimonial::factory()->count(5)->create();

    $service = new TestimonialService();
    $testimonials = $service->getTestimonials();

    expect($testimonials)->toHaveCount(5);
});

it('throws exception when no testimonials exist', function (): void {
    Testimonial::query()->delete();

    $service = new TestimonialService();

    $this->expectException(TestimonialNotFoundException::class);
    $service->getTestimonials();
});
