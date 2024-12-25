<?php

declare(strict_types=1);

namespace Database\Seeders\SiteSetting;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::insert([
            [
                'key' => 'company_name',
                'value' => 'Plombiers Experts'
            ],
            [
                'key' => 'company_phone',
                'value' => '(555) 123-4567'
            ],
            [
                'key' => 'company_email',
                'value' => 'info@expertplumbers.com'
            ],
            [
                'key' => 'company_address',
                'value' => '123 Rue des Plombiers, Pipetown, PT 12345'
            ],
            [
                'key' => 'social_media_facebook',
                'value' => 'https://facebook.com/expertplumbers'
            ],
            [
                'key' => 'social_media_twitter',
                'value' => 'https://twitter.com/expertplumbers'
            ],
            [
                'key' => 'social_media_instagram',
                'value' => 'https://instagram.com/expertplumbers'
            ],
        ]);
    }
}
