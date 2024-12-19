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
                'key' => 'nom_entreprise',
                'value' => 'Plombiers Experts'
            ],
            [
                'key' => 'telephone_entreprise',
                'value' => '(555) 123-4567'
            ],
            [
                'key' => 'email_entreprise',
                'value' => 'info@expertplumbers.com'
            ],
            [
                'key' => 'adresse_entreprise',
                'value' => '123 Rue des Plombiers, Pipetown, PT 12345'
            ],
            [
                'key' => 'reseaux_sociaux_facebook',
                'value' => 'https://facebook.com/expertplumbers'
            ],
            [
                'key' => 'reseaux_sociaux_twitter',
                'value' => 'https://twitter.com/expertplumbers'
            ],
            [
                'key' => 'reseaux_sociaux_instagram',
                'value' => 'https://instagram.com/expertplumbers'
            ],
        ]);
    }
}
