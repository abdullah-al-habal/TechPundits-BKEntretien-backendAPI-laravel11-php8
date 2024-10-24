<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Factories\UserFactory;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        UserFactory::new()->create(attributes: [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(length: 10),
            'is_admin' => true,
        ]);
    }
}
