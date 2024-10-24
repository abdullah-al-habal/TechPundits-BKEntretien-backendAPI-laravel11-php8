<?php

declare(strict_types=1);

namespace App\Filament\Resources\Unlocking\UnlockingSectionResource\Pages;

use App\Filament\Resources\Unlocking\UnlockingSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnlockingSections extends ListRecords
{
    protected static string $resource = UnlockingSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
