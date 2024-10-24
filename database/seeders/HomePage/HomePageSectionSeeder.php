<?php

declare(strict_types=1);

namespace Database\Seeders\HomePage;

use App\Models\HomePage;
use App\Models\HomePageSection;
use Illuminate\Database\Seeder;

class HomePageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $homePage = HomePage::firstOrCreate();

        HomePageSection::updateOrCreate(
            ['home_page_id' => $homePage->id, 'title' => 'Expert Plumbing Services'],
            [
                'description' => 'Our team of skilled plumbers provides top-notch services for all your plumbing needs, from repairs to installations.',
                'image' => 'expert-services.jpg',
            ]
        );

        HomePageSection::updateOrCreate(
            ['home_page_id' => $homePage->id, 'title' => '24/7 Emergency Support'],
            [
                'description' => 'We offer round-the-clock emergency plumbing services to ensure your peace of mind at any time of day or night.',
                'image' => 'emergency-support.jpg',
            ]
        );

        HomePageSection::updateOrCreate(
            ['home_page_id' => $homePage->id, 'title' => 'Quality Guaranteed'],
            [
                'description' => 'We stand behind our work with a satisfaction guarantee, ensuring that every job is completed to the highest standards.',
                'image' => 'quality-guarantee.jpg',
            ]
        );
    }
}
