<?php

declare(strict_types=1);

namespace App\Services\Testimonial;

use App\Exceptions\API\V1\Testimonial\TestimonialNotFoundException;
use App\Models\Testimonial;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonialService
{
    public function getTestimonials(int $perPage = 15): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $testimonials */
        $testimonials = Testimonial::with('sections')->paginate(perPage: $perPage);

        if ($testimonials->isEmpty()) {
            throw new TestimonialNotFoundException();
        }

        // Use loadMissing to ensure all relations are loaded
        $testimonials->loadMissing('sections');

        return $testimonials;
    }
}
