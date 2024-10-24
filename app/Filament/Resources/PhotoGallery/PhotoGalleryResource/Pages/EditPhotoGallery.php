<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery\PhotoGalleryResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotoGallery extends EditRecord
{
    protected static string $resource = PhotoGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
