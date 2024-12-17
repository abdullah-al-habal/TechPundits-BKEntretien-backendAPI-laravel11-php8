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
        // Create a contact us instance
        $contactUs = ContactUs::firstOrCreate([
            'banner_image' => 'path/to/banner_image.jpg',
            'banner_image_alt_text' => 'Banner Image Alt Text',
            'banner_image_text' => 'Banner Image Description',
            'main_image' => 'path/to/main_image.jpg',
            'main_image_alt_text' => 'Main Image Alt Text',
            'first_description' => 'First Description',
            'second_description' => 'Second Description',
        ]);

        // Insert sections related to contact us
        ContactUsSection::insert([
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Our Services',
                'description' => 'We offer a wide range of plumbing services including repairs, installations, and maintenance for both residential and commercial properties.',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Business Hours',
                'description' => 'Monday - Friday: 8:00 AM - 6:00 PM\nSaturday: 9:00 AM - 2:00 PM\nSunday: Closed\nEmergency services available 24/7',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Service Areas',
                'description' => 'We proudly serve Pipetown and surrounding areas within a 50-mile radius. Call us to check if we cover your location.',
            ],
        ]);
    }
}
