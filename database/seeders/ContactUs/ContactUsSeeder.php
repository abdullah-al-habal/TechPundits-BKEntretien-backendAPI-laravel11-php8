<?php

declare(strict_types=1);

namespace Database\Seeders\ContactUs;

use App\Models\ContactUs;
use App\Models\ContactUsSection;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    public function run(): void
    {
        // Créer une instance Contactez-nous
        $contactUs = ContactUs::firstOrCreate([
            'banner_image' => 'chemin/vers/banner_image.jpg',
            'banner_image_alt_text' => "Texte alternatif de l'image de la bannière",
            'banner_image_text' => "Description de l'image de la bannière",
            'main_image' => 'chemin/vers/main_image.jpg',
            'main_image_alt_text' => "Texte alternatif de l'image principale",
            'first_description' => 'Première description',
            'second_description' => 'Deuxième description',
        ]);

        // Insérer les sections liées à Contactez-nous
        ContactUsSection::insert([
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Contactez-nous',
                'description' => "Nous sommes là pour répondre à tous vos besoins en plomberie. Contactez-nous dès aujourd'hui pour un service expert.",
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Notre Emplacement',
                'description' => '123 Rue des Plombiers, Pipetown, PT 12345',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Informations de Contact',
                'description' => 'Téléphone : (555) 123-4567\nEmail : info@expertplumbers.com',
            ],
        ]);
    }
}
