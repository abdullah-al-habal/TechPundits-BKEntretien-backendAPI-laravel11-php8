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
        $contactUs = ContactUs::firstOrCreate();

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
