<?php

declare(strict_types=1);

namespace Database\Seeders\Testimonial;

use App\Models\Testimonial;
use App\Models\TestimonialSection;
use Illuminate\Database\Seeder;

class TestimonialSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Créer une instance de témoignage
        $testimonial = Testimonial::firstOrCreate([
            'banner_image' => 'chemin/vers/banner_image.jpg',
            'banner_image_alt_text' => 'Texte alternatif de l\'image de la bannière',
            'banner_image_text' => 'Description de l\'image de la bannière',
            'main_image' => 'chemin/vers/main_image.jpg',
            'main_image_alt_text' => 'Texte alternatif de l\'image principale',
            'main_image_text' => 'Description de l\'image principale',
        ]);

        // Insérer des sections liées au témoignage
        TestimonialSection::insert([
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Satisfaction Client',
                'description' => 'Nos clients nous évaluent constamment très bien pour nos services de plomberie professionnels et efficaces.',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Solutions Expert',
                'description' => 'Nous sommes fiers de fournir des solutions expertes aux problèmes de plomberie les plus complexes.',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Service Fiable',
                'description' => 'Notre équipe est connue pour sa fiabilité et sa ponctualité, garantissant que vos problèmes de plomberie sont résolus rapidement.',
            ],
        ]);
    }
}
