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
            'banner_image_alt_text' => 'Bannière par défaut',
            'banner_image_text' => 'Bienvenue à nos services de plomberie',
            'main_image' => 'default-main.jpg',
            'main_image_alt_text' => 'Image principale par défaut',
            'main_image_text' => 'Solutions de plomberie de qualité',
        ]);

        Faq::updateOrCreate(
            ['home_page_id' => $homePage->id, 'question' => 'Quels services proposez-vous ?'],
            [
                'answer' => 'Nous offrons une large gamme de services de plomberie incluant le nettoyage de drains, la réparation de tuyaux, l\'installation de chauffe-eau et la plomberie d\'urgence.',
                'image' => 'services.jpg',
            ]
        );

        Faq::updateOrCreate(
            ['home_page_id' => $homePage->id, 'question' => 'Quelle est votre réactivité aux urgences ?'],
            [
                'answer' => 'Nous offrons des services d\'urgence 24/7 et nous visons à répondre à tous les appels urgents dans un délai d\'une heure.',
                'image' => 'emergency.jpg',
            ]
        );

        Faq::updateOrCreate(
            ['home_page_id' => $homePage->id, 'question' => 'Proposez-vous des devis gratuits ?'],
            [
                'answer' => 'Oui, nous fournissons des devis gratuits pour tous nos services. Contactez-nous pour planifier un rendez-vous.',
                'image' => 'estimate.jpg',
            ]
        );
    }
}
