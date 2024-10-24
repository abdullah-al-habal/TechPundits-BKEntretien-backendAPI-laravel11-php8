<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactUs\ContactUsSectionResource\Pages;

use App\Filament\Resources\ContactUs\ContactUsSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUsSections extends ListRecords
{
    protected static string $resource = ContactUsSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
