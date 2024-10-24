<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\ContactUs\ContactUsSectionSeeder;
use Database\Seeders\ContactUs\ContactUsSeeder;
use Database\Seeders\DrainCleaning\DrainCleaningSectionSeeder;
use Database\Seeders\DrainCleaning\DrainCleaningSeeder;
use Database\Seeders\Faq\FaqSeeder;
use Database\Seeders\HomePage\HomePageSectionSeeder;
use Database\Seeders\HomePage\HomePageSeeder;
use Database\Seeders\PhotoGallery\PhotoGallerySectionImageSeeder;
use Database\Seeders\PhotoGallery\PhotoGallerySectionSeeder;
use Database\Seeders\PhotoGallery\PhotoGallerySeeder;
use Database\Seeders\SiteSetting\SiteSettingSeeder;
use Database\Seeders\Testimonial\TestimonialSectionSeeder;
use Database\Seeders\Testimonial\TestimonialSeeder;
use Database\Seeders\Unlocking\UnlockingSectionSeeder;
use Database\Seeders\Unlocking\UnlockingSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            DrainCleaningSeeder::class,
            DrainCleaningSectionSeeder::class,
            UnlockingSeeder::class,
            UnlockingSectionSeeder::class,
            TestimonialSeeder::class,
            TestimonialSectionSeeder::class,
            PhotoGallerySeeder::class,
            PhotoGallerySectionSeeder::class,
            PhotoGallerySectionImageSeeder::class,
            HomePageSeeder::class,
            HomePageSectionSeeder::class,
            FaqSeeder::class,
            ContactUsSeeder::class,
            ContactUsSectionSeeder::class,
        ]);
    }
}
