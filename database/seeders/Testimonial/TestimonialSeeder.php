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
        // Create a testimonial instance
        $testimonial = Testimonial::firstOrCreate([
            'banner_image' => 'path/to/banner_image.jpg',
            'banner_image_alt_text' => 'Banner Image Alt Text',
            'banner_image_text' => 'Banner Image Description',
            'main_image' => 'path/to/main_image.jpg',
            'main_image_alt_text' => 'Main Image Alt Text',
            'main_image_text' => 'Main Image Description',
        ]);

        // Insert sections related to the testimonial
        TestimonialSection::insert([
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Satisfied Customer',
                'description' => 'Expert Plumbers provided excellent service. They were prompt, professional, and solved our plumbing issue quickly. - John Doe',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Great Experience',
                'description' => 'I highly recommend Expert Plumbers. Their team was knowledgeable and courteous. They did a fantastic job! - Jane Smith',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Reliable Service',
                'description' => "Expert Plumbers are my go-to for all plumbing needs. They're reliable, efficient, and always deliver quality work. - Mike Johnson",
            ],
        ]);
    }
}
