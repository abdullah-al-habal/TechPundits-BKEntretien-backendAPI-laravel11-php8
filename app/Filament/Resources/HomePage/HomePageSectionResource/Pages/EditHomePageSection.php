<?php

namespace App\Filament\Resources\HomePage\HomePageSectionResource\Pages;

use App\Filament\Resources\HomePage\HomePageSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomePageSection extends EditRecord
{
    protected static string $resource = HomePageSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
