<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactUs\ContactUsResource\Pages;

use App\Filament\Resources\ContactUs\ContactUsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUs extends EditRecord
{
    protected static string $resource = ContactUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
