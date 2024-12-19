<?php

declare(strict_types=1);

namespace Database\Seeders\Unlocking;

use App\Models\Unlocking;
use App\Models\UnlockingSection;
use Illuminate\Database\Seeder;

class UnlockingSeeder extends Seeder
{
    public function run(): void
    {
        $unlocking = Unlocking::firstOrCreate([
            'banner_image' => 'banniere-deverrouillage.jpg',
            'banner_image_alt_text' => 'Bannière des services de déverrouillage',
            'banner_image_text' => 'Solutions de Déverrouillage Experts',
            'main_image' => 'deverrouillage-principal.jpg',
            'main_image_alt_text' => 'Service de déverrouillage professionnel',
            'main_image_text' => 'Déverrouillage Rapide et Fiable',
        ]);

        UnlockingSection::updateOrCreate(
            ['unlocking_id' => $unlocking->id, 'title' => 'Déverrouillage d\'Urgence'],
            [
                'description' => 'Nous offrons des services de déverrouillage d\'urgence 24/7 pour votre maison, voiture ou bureau.',
            ]
        );

        UnlockingSection::updateOrCreate(
            ['unlocking_id' => $unlocking->id, 'title' => 'Techniques Avancées'],
            [
                'description' => 'Nos experts utilisent les dernières techniques et outils pour déverrouiller tout type de serrure en toute sécurité.',
            ]
        );

        UnlockingSection::updateOrCreate(
            ['unlocking_id' => $unlocking->id, 'title' => 'Tarifs Abordables'],
            [
                'description' => 'Nous fournissons des services de déverrouillage de haute qualité à des prix compétitifs.',
            ]
        );
    }
}
