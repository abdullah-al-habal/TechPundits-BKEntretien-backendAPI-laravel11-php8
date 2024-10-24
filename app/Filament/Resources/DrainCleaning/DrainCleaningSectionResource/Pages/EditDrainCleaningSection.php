<?php

namespace App\Filament\Resources\DrainCleaning\DrainCleaningSectionResource\Pages;

use App\Filament\Resources\DrainCleaning\DrainCleaningSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDrainCleaningSection extends EditRecord
{
    protected static string $resource = DrainCleaningSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
