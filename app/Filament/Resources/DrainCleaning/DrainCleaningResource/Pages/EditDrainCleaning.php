<?php

namespace App\Filament\Resources\DrainCleaning\DrainCleaningResource\Pages;

use App\Filament\Resources\DrainCleaning\DrainCleaningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDrainCleaning extends EditRecord
{
    protected static string $resource = DrainCleaningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
