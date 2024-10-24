<?php

declare(strict_types=1);

namespace App\Filament\Resources\HomePage\HomePageResource\Pages;

use App\Filament\Resources\HomePage\HomePageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomePage extends CreateRecord
{
    protected static string $resource = HomePageResource::class;
}
