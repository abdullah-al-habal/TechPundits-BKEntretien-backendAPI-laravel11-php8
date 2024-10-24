<?php

declare(strict_types=1);

namespace App\Filament\Resources\HomePage\HomePageSectionResource\Pages;

use App\Filament\Resources\HomePage\HomePageSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomePageSection extends CreateRecord
{
    protected static string $resource = HomePageSectionResource::class;
}
