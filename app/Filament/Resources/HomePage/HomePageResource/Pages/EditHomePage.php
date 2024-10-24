<?php

declare(strict_types=1);

namespace App\Filament\Resources\HomePage\HomePageResource\Pages;

use App\Filament\Resources\HomePage\HomePageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomePage extends EditRecord
{
    protected static string $resource = HomePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
