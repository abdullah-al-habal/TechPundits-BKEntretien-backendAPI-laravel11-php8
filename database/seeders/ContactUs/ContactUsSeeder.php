<?php

declare(strict_types=1);

namespace Database\Seeders\ContactUs;

use App\Models\ContactUs;
use App\Models\ContactUsSection;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
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
                'title' => 'Get in Touch',
                'description' => 'We\'re here to help with all your plumbing needs. Contact us today for expert service.',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Our Location',
                'description' => '123 Plumber Street, Pipetown, PT 12345',
            ],
            [
                'contact_us_id' => $contactUs->id,
                'title' => 'Contact Information',
                'description' => 'Phone: (555) 123-4567\nEmail: info@expertplumbers.com',
            ],
        ]);
    }
}
