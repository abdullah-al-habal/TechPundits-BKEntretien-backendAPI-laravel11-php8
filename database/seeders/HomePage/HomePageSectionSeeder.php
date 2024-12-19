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
            ['home_page_id' => $homePage->id, 'title' => 'Services de Plomberie Experts'],
            [
                'description' => 'Notre équipe de plombiers qualifiés fournit des services de première qualité pour tous vos besoins en plomberie, des réparations aux installations.',
                'image' => 'expert-services.jpg',
            ]
        );

        HomePageSection::updateOrCreate(
            ['home_page_id' => $homePage->id, 'title' => 'Support d\'Urgence 24/7'],
            [
                'description' => 'Nous offrons des services de plomberie d\'urgence 24h/24 et 7j/7 pour assurer votre tranquillité d\'esprit à tout moment de la journée ou de la nuit.',
                'image' => 'emergency-support.jpg',
            ]
        );

        HomePageSection::updateOrCreate(
            ['home_page_id' => $homePage->id, 'title' => 'Qualité Garantie'],
            [
                'description' => 'Nous garantissons notre travail avec une satisfaction garantie, en veillant à ce que chaque travail soit effectué selon les normes les plus élevées.',
                'image' => 'quality-guarantee.jpg',
            ]
        );
    }
}
