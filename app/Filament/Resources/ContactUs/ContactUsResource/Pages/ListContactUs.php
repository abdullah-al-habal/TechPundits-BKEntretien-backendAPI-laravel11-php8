<?php

namespace App\Filament\Resources\ContactUs\ContactUsResource\Pages;

use App\Filament\Resources\ContactUs\ContactUsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUs extends ListRecords
{
    protected static string $resource = ContactUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
