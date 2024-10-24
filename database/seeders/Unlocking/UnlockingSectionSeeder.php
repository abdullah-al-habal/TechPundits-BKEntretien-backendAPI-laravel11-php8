<?php

declare(strict_types=1);

namespace Database\Seeders\Unlocking;

use App\Models\Unlocking;
use App\Models\UnlockingSection;
use Illuminate\Database\Seeder;

class UnlockingSectionSeeder extends Seeder
{
    public function run(): void
    {
        $unlocking = Unlocking::firstOrCreate([
            'banner_image' => 'unlocking-banner.jpg',
            'banner_image_alt_text' => 'Unlocking services banner',
            'banner_image_text' => 'Expert Unlocking Solutions',
            'main_image' => 'unlocking-main.jpg',
            'main_image_alt_text' => 'Professional unlocking service',
            'main_image_text' => 'Fast and Reliable Unlocking',
        ]);

        UnlockingSection::updateOrCreate(
            ['unlocking_id' => $unlocking->id, 'title' => 'Emergency Unlocking'],
            [
                'description' => 'We offer 24/7 emergency unlocking services for your home, car, or office.',
            ]
        );

        UnlockingSection::updateOrCreate(
            ['unlocking_id' => $unlocking->id, 'title' => 'Advanced Techniques'],
            [
                'description' => 'Our experts use the latest techniques and tools to unlock any type of lock safely.',
            ]
        );

        UnlockingSection::updateOrCreate(
            ['unlocking_id' => $unlocking->id, 'title' => 'Affordable Rates'],
            [
                'description' => 'We provide high-quality unlocking services at competitive prices.',
            ]
        );
    }
}
