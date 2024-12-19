<?php

declare(strict_types=1);

namespace Database\Seeders\ContactUs;

use App\Models\ContactUs;
use App\Models\ContactUsSection;
use Illuminate\Database\Seeder;

class ContactUsSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Créer une instance Contactez-nous
        $contactUs = ContactUs::firstOrCreate([
            'banner_image' => 'chemin/vers/banner_image.jpg',
            'banner_image_alt_text' => "Texte alternatif de l'image de la bannière",
            'banner_image_text' => 'Description de l\'image de la bannière',
            'main_image' => 'chemin/vers/main_image.jpg',
            'main_image_alt_text' => 'Texte alternatif de l\'image principale',
            'first_description' => 'Première description',
            'second_description' => 'Deuxième description',
        ]);

        // Insérer les sections liées à Contactez-nous
        ContactUsSection::insert([
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Nos Services',
                'description' => 'Nous proposons une large gamme de services de plomberie, y compris les réparations, les installations et la maintenance pour les propriétés résidentielles et commerciales.',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Horaires',
                'description' => 'Lundi - Vendredi : 8h00 - 18h00\nSamedi : 9h00 - 14h00\nDimanche : Fermé\nServices d\'urgence disponibles 24h/24 et 7j/7',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Zones de Service',
                'description' => 'Nous sommes fiers de servir Pipetown et les environs dans un rayon de 80 kilomètres. Appelez-nous pour vérifier si nous couvrons votre emplacement.',
            ],
        ]);
    }
}
