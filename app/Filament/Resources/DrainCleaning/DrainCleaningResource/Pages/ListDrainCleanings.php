<?php

namespace App\Filament\Resources\DrainCleaning\DrainCleaningResource\Pages;

use App\Filament\Resources\DrainCleaning\DrainCleaningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDrainCleanings extends ListRecords
{
    protected static string $resource = DrainCleaningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
