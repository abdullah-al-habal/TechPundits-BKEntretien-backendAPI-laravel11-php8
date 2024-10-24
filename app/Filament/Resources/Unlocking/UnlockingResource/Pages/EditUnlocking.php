<?php

namespace App\Filament\Resources\Unlocking\UnlockingResource\Pages;

use App\Filament\Resources\Unlocking\UnlockingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnlocking extends EditRecord
{
    protected static string $resource = UnlockingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
