<?php

declare(strict_types=1);

namespace Database\Seeders\PhotoGallery;

use App\Models\PhotoGallery;
use App\Models\PhotoGallerySection;
use Illuminate\Database\Seeder;

class PhotoGallerySectionSeeder extends Seeder
{
    public function run(): void
    {
        $photoGallery = PhotoGallery::firstOrCreate();

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Kitchen Plumbing'],
            []
        );

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Bathroom Renovations'],
            []
        );

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Emergency Repairs'],
            []
        );

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Outdoor Plumbing'],
            []
        );
    }
}
