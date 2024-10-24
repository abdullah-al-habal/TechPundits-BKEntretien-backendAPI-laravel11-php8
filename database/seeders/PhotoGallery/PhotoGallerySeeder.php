<?php

declare(strict_types=1);

namespace Database\Seeders\PhotoGallery;

use App\Models\PhotoGallery;
use Illuminate\Database\Seeder;

class PhotoGallerySeeder extends Seeder
{
    public function run(): void
    {
        PhotoGallery::create([
            'banner_image' => 'photo-gallery-banner.jpg',
            'banner_image_alt_text' => 'Our Photo Gallery',
            'title' => 'Plumbing Project Gallery',
            'description' => 'Explore our completed plumbing projects',
            'main_image' => 'gallery-main.jpg',
            'main_image_alt_text' => 'Showcase of our best work',
            'main_image_text' => 'Quality Plumbing Solutions',
        ]);
    }
}
