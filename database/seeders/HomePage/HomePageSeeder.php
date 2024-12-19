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
            'banner_image_alt_text' => 'Bienvenue à nos services de plomberie',
            'banner_image_text' => 'Solutions de plomberie expertes pour votre maison',
            'main_image' => 'main-service.jpg',
            'main_image_alt_text' => 'Plombier professionnel au travail',
            'main_image_text' => 'Service de qualité garanti',
        ]);
    }
}
