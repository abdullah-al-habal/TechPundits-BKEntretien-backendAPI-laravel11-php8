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
            'banner_image_alt_text' => 'Professional Drain Cleaning Services',
            'banner_image_text' => 'Expert Drain Cleaning Solutions',
            'title' => 'Professional Drain Cleaning Services',
            'first_description' => 'We offer top-notch drain cleaning services to keep your plumbing system running smoothly.',
            'second_description' => 'Our experienced technicians use advanced equipment to tackle even the toughest clogs.',
            'main_image' => 'main-drain-cleaning-image.jpg',
            'main_image_alt_text' => 'Drain cleaning in progress',
            'main_image_text' => 'Our team at work, ensuring your drains are clear and functional.',
        ]);

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
