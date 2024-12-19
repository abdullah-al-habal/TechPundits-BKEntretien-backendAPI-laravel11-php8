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
            'banner_image_alt_text' => 'Notre Galerie de Photos',
            'title' => 'Galerie de Projets de Plomberie',
            'description' => 'Explorez nos projets de plomberie terminés',
            'main_image' => 'gallery-main.jpg',
            'main_image_alt_text' => 'Présentation de notre meilleur travail',
            'main_image_text' => 'Solutions de Plomberie de Qualité',
        ]);
    }
}
