<?php

declare(strict_types=1);

namespace Database\Seeders\PhotoGallery;

use App\Models\PhotoGallerySection;
use App\Models\PhotoGallerySectionImage;
use Illuminate\Database\Seeder;

class PhotoGallerySectionImageSeeder extends Seeder
{
    public function run(): void
    {
        $sections = PhotoGallerySection::all();

        foreach ($sections as $section) {
            PhotoGallerySectionImage::create([
                'photo_gallery_section_id' => $section->id,
                'image' => 'gallery-' . strtolower(str_replace(' ', '-', $section->title)) . '.jpg',
                'alt_text' => 'Projet ' . $section->title,
                'description' => 'Une vitrine de notre travail sur ' . $section->title . '.',
            ]);

            PhotoGallerySectionImage::create([
                'photo_gallery_section_id' => $section->id,
                'image' => 'gallery-' . strtolower(str_replace(' ', '-', $section->title)) . '-2.jpg',
                'alt_text' => 'Un autre projet ' . $section->title,
                'description' => 'Un autre exemple de notre expertise en ' . $section->title . '.',
            ]);
        }
    }
}
