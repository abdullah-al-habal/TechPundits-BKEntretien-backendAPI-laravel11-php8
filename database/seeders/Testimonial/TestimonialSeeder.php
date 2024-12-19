<?php

declare(strict_types=1);

namespace Database\Seeders\Testimonial;

use App\Models\Testimonial;
use App\Models\TestimonialSection;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
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
                'title' => 'Client Satisfait',
                'description' => 'Plombiers Experts ont fourni un excellent service. Ils étaient rapides, professionnels et ont résolu notre problème de plomberie rapidement. - John Doe',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Super Expérience',
                'description' => 'Je recommande vivement Plombiers Experts. Leur équipe était compétente et courtoise. Ils ont fait un excellent travail! - Jane Smith',
            ],
            [
                'testimonial_id' => $testimonial->id,
                'title' => 'Service Fiable',
                'description' => "Plombiers Experts sont mes références pour tous les besoins en plomberie. Ils sont fiables, efficaces et toujours fournissent un travail de qualité. - Mike Johnson",
            ],
        ]);
    }
}
