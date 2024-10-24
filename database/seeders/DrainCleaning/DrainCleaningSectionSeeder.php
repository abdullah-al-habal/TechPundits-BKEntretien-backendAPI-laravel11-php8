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
            ['drain_cleaning_id' => $drainCleaning->id, 'title' => 'Professional Drain Cleaning'],
            [
                'description' => 'Our expert technicians use state-of-the-art equipment to clear even the toughest clogs and keep your drains flowing smoothly.',
            ]
        );

        DrainCleaningSection::updateOrCreate(
            ['drain_cleaning_id' => $drainCleaning->id, 'title' => 'Common Drain Issues'],
            [
                'description' => 'We handle a variety of drain problems including slow drains, complete blockages, foul odors, and recurring clogs in sinks, showers, and toilets.',
            ]
        );

        DrainCleaningSection::updateOrCreate(
            ['drain_cleaning_id' => $drainCleaning->id, 'title' => 'Preventive Maintenance'],
            [
                'description' => 'Regular drain cleaning can prevent costly repairs and extend the life of your plumbing system. Ask about our maintenance plans.',
            ]
        );
    }
}
