<?php

declare(strict_types=1);

namespace Database\Seeders\Testimonial;

use App\Models\Testimonial;
use App\Models\TestimonialSection;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonial = Testimonial::firstOrCreate();

        TestimonialSection::updateOrCreate(
            ['testimonial_id' => $testimonial->id, 'title' => 'Satisfied Customer'],
            [
                'description' => 'Expert Plumbers provided excellent service. They were prompt, professional, and solved our plumbing issue quickly. - John Doe',
            ]
        );

        TestimonialSection::updateOrCreate(
            ['testimonial_id' => $testimonial->id, 'title' => 'Great Experience'],
            [
                'description' => 'I highly recommend Expert Plumbers. Their team was knowledgeable and courteous. They did a fantastic job! - Jane Smith',
            ]
        );

        TestimonialSection::updateOrCreate(
            ['testimonial_id' => $testimonial->id, 'title' => 'Reliable Service'],
            [
                'description' => "Expert Plumbers are my go-to for all plumbing needs. They're reliable, efficient, and always deliver quality work. - Mike Johnson",
            ]
        );
    }
}
