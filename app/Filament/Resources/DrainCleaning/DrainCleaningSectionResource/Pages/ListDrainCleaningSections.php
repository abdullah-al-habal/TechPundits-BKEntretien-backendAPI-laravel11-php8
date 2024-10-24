<?php

namespace App\Filament\Resources\DrainCleaning\DrainCleaningSectionResource\Pages;

use App\Filament\Resources\DrainCleaning\DrainCleaningSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDrainCleaningSections extends ListRecords
{
    protected static string $resource = DrainCleaningSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
