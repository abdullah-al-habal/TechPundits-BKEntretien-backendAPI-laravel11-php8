<?php

declare(strict_types=1);

namespace Database\Seeders\DrainCleaning;

use App\Models\DrainCleaning;
use App\Models\DrainCleaningSection;
use Illuminate\Database\Seeder;

class DrainCleaningSectionSeeder extends Seeder
{
    public function run(): void
    {
        $drainCleaning = DrainCleaning::firstOrCreate();

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
