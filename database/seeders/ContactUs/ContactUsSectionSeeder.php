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
        $contactUs = ContactUs::firstOrCreate();

        ContactUsSection::updateOrCreate(
            ['contact_us_id' => $contactUs->id, 'title' => 'Our Services'],
            [
                'description' => 'We offer a wide range of plumbing services including repairs, installations, and maintenance for both residential and commercial properties.',
            ]
        );

        ContactUsSection::updateOrCreate(
            ['contact_us_id' => $contactUs->id, 'title' => 'Business Hours'],
            [
                'description' => 'Monday - Friday: 8:00 AM - 6:00 PM\nSaturday: 9:00 AM - 2:00 PM\nSunday: Closed\nEmergency services available 24/7',
            ]
        );

        ContactUsSection::updateOrCreate(
            ['contact_us_id' => $contactUs->id, 'title' => 'Service Areas'],
            [
                'description' => 'We proudly serve Pipetown and surrounding areas within a 50-mile radius. Call us to check if we cover your location.',
            ]
        );
    }
}
