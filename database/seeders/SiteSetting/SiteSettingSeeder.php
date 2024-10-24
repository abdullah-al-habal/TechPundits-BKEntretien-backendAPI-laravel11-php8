<?php

declare(strict_types=1);

namespace Database\Seeders\SiteSetting;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'company_name'],
            ['value' => 'Expert Plumbers']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'company_phone'],
            ['value' => '(555) 123-4567']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'company_email'],
            ['value' => 'info@expertplumbers.com']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'company_address'],
            ['value' => '123 Plumber Street, Pipetown, PT 12345']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'social_media_facebook'],
            ['value' => 'https://facebook.com/expertplumbers']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'social_media_twitter'],
            ['value' => 'https://twitter.com/expertplumbers']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'social_media_instagram'],
            ['value' => 'https://instagram.com/expertplumbers']
        );
    }
}
