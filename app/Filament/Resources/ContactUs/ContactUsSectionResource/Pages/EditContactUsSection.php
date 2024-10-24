<?php

namespace App\Filament\Resources\ContactUs\ContactUsSectionResource\Pages;

use App\Filament\Resources\ContactUs\ContactUsSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUsSection extends EditRecord
{
    protected static string $resource = ContactUsSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
