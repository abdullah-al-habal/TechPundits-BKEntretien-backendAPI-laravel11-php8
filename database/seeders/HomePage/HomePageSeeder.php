<?php

declare(strict_types=1);

namespace Database\Seeders\HomePage;

use App\Models\HomePage;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        HomePage::create([
            'banner_image' => 'banner.jpg',
            'banner_image_alt_text' => 'Welcome to our plumbing services',
            'banner_image_text' => 'Expert Plumbing Solutions for Your Home',
            'main_image' => 'main-service.jpg',
            'main_image_alt_text' => 'Professional plumber at work',
            'main_image_text' => 'Quality Service Guaranteed',
        ]);
    }
}
