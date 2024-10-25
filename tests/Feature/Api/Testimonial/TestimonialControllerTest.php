<?php

declare(strict_types=1);

use App\Exceptions\API\V1\Testimonial\TestimonialNotFoundException;
use App\Models\Testimonial;
use App\Services\Testimonial\TestimonialService;

it('returns testimonials when they exist', function (): void {
    // Create some test testimonials
    Testimonial::factory()->count(5)->create();

    $response = $this->get('/api/v1/testimonials');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['sections'],
            ],
            'meta' => ['version', 'api_version'],
        ]);
});

it('returns error when no testimonials exist', function (): void {
    // Ensure no testimonials exist
    Testimonial::query()->delete();

    // Mock the service to throw the exception
    $this->mock(TestimonialService::class)
        ->shouldReceive('getTestimonials')
        ->andThrow(new TestimonialNotFoundException());

    $response = $this->get('/api/v1/testimonials');

    $response->assertStatus(404)
        ->assertJson(['success' => false]);
});
