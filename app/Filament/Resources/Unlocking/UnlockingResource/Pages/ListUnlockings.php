<?php

namespace App\Filament\Resources\Unlocking\UnlockingResource\Pages;

use App\Filament\Resources\Unlocking\UnlockingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnlockings extends ListRecords
{
    protected static string $resource = UnlockingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
