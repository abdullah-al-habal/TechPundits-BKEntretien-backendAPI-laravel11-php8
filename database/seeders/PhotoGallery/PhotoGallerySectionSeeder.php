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
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Plomberie de Cuisine'],
            []
        );

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Rénovations de Salle de Bain'],
            []
        );

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Réparations d\'Urgence'],
            []
        );

        PhotoGallerySection::updateOrCreate(
            ['photo_gallery_id' => $photoGallery->id, 'title' => 'Plomberie Extérieure'],
            []
        );
    }
}
