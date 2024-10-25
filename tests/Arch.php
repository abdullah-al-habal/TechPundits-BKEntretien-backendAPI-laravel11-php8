<?php

declare(strict_types=1);

use Pest\Arch;

// Layer Dependencies
test('architecture', static function (): void {
    Arch::layers()
        ->define('Models', ['App\Models\*'])
        ->define('Controllers', ['App\Http\Controllers\*'])
        ->define('Services', ['App\Services\*'])
        ->define('Repositories', ['App\Repositories\*'])
        ->assert([
            'Controllers' => ['Models', 'Services'],
            'Services' => ['Models', 'Repositories'],
            'Repositories' => ['Models'],
        ]);
});

// Naming Conventions
test('controller naming convention', static function (): void {
    Arch::expect('App\Http\Controllers')->toHaveSuffix('Controller');
});

// Type Safety
test('strict types declaration', static function (): void {
    Arch::expect('App')->toUseStrictTypes();
});

// Interface Implementation
test('repositories implement interfaces', static function (): void {
    Arch::expect('App\Repositories')->toImplement('App\Contracts\RepositoryInterface');
});

// Dependency Rules
test('models usage restriction', static function (): void {
    Arch::expect('App\Models')
        ->toOnlyBeUsedIn([
            'App\Http\Controllers',
            'App\Repositories',
            'App\Services',
            'Database\Factories',
            'Database\Seeders',
        ]);
});
