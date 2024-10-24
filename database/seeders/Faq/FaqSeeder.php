<?php

declare(strict_types=1);

namespace Database\Seeders\Faq;

use App\Models\Faq;
use App\Models\HomePage;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $homePage = HomePage::firstOrCreate([
            'banner_image' => 'default-banner.jpg',
            'banner_image_alt_text' => 'Default Banner',
            'banner_image_text' => 'Welcome to our plumbing services',
            'main_image' => 'default-main.jpg',
            'main_image_alt_text' => 'Default Main Image',
            'main_image_text' => 'Quality Plumbing Solutions',
        ]);

        Faq::updateOrCreate(
            ['home_page_id' => $homePage->id, 'question' => 'What services do you offer?'],
            [
                'answer' => 'We offer a wide range of plumbing services including drain cleaning, pipe repair, water heater installation, and emergency plumbing.',
                'image' => 'services.jpg',
            ]
        );

        Faq::updateOrCreate(
            ['home_page_id' => $homePage->id, 'question' => 'How quickly can you respond to emergencies?'],
            [
                'answer' => 'We offer 24/7 emergency services and aim to respond to all urgent calls within 1 hour.',
                'image' => 'emergency.jpg',
            ]
        );

        Faq::updateOrCreate(
            ['home_page_id' => $homePage->id, 'question' => 'Do you offer free estimates?'],
            [
                'answer' => 'Yes, we provide free estimates for all our services. Contact us to schedule an appointment.',
                'image' => 'estimate.jpg',
            ]
        );
    }
}
