<?php

declare(strict_types=1);

namespace Database\Seeders\DrainCleaning;

use App\Models\DrainCleaning;
use App\Models\DrainCleaningSection;
use Illuminate\Database\Seeder;

class DrainCleaningSeeder extends Seeder
{
    public function run(): void
    {
        $drainCleaning = DrainCleaning::firstOrCreate([
            'banner_image' => 'default-drain-cleaning-banner.jpg',
            'banner_image_alt_text' => 'Services Professionnels de Nettoyage des Drains',
            'banner_image_text' => 'Solutions Expert en Nettoyage des Drains',
            'title' => 'Services Professionnels de Nettoyage des Drains',
            'first_description' => 'Nous offrons des services de nettoyage de drains de première qualité pour assurer le bon fonctionnement de votre système de plomberie.',
            'second_description' => 'Nos techniciens expérimentés utilisent des équipements avancés pour éliminer même les bouchons les plus tenaces.',
            'main_image' => 'main-drain-cleaning-image.jpg',
            'main_image_alt_text' => 'Nettoyage des drains en cours',
            'main_image_text' => 'Notre équipe au travail, garantissant que vos drains sont dégagés et fonctionnels.',
        ]);

        DrainCleaningSection::updateOrCreate(
            ['drain_cleaning_id' => $drainCleaning->id, 'title' => 'Nettoyage Professionnel des Drains'],
            [
                'description' => 'Nos techniciens experts utilisent un équipement de pointe pour éliminer même les bouchons les plus tenaces et garantir que vos drains fonctionnent parfaitement.',
            ]
        );

        DrainCleaningSection::updateOrCreate(
            ['drain_cleaning_id' => $drainCleaning->id, 'title' => 'Problèmes Courants de Drain'],
            [
                'description' => 'Nous traitons divers problèmes de drains, y compris les drains lents, les obstructions complètes, les mauvaises odeurs et les bouchons récurrents dans les éviers, les douches et les toilettes.',
            ]
        );

        DrainCleaningSection::updateOrCreate(
            ['drain_cleaning_id' => $drainCleaning->id, 'title' => 'Entretien Préventif'],
            [
                'description' => 'Un nettoyage régulier des drains peut prévenir des réparations coûteuses et prolonger la durée de vie de votre système de plomberie. Demandez-nous des informations sur nos plans de maintenance.',
            ]
        );
    }
}
