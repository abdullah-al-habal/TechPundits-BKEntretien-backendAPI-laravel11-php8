<?php

declare(strict_types=1);

namespace Database\Seeders\Testimonial;

use App\Models\Testimonial;
use App\Models\TestimonialSection;
use Illuminate\Database\Seeder;

class TestimonialSectionSeeder extends Seeder
{
    public function run(): void
    {
        $testimonial = Testimonial::firstOrCreate();

        TestimonialSection::insert([
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Customer Satisfaction',
                'description' => 'Our customers consistently rate us highly for our professional and efficient plumbing services.',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Expert Solutions',
                'description' => 'We pride ourselves on providing expert solutions to even the most complex plumbing problems.',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Reliable Service',
                'description' => 'Our team is known for its reliability and punctuality, ensuring your plumbing issues are addressed promptly.',
            ],
        ]);
    }
}
