<?php

declare(strict_types=1);

namespace App\Filament\Resources\HomePage\HomePageSectionResource\Pages;

use App\Filament\Resources\HomePage\HomePageSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomePageSections extends ListRecords
{
    protected static string $resource = HomePageSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
