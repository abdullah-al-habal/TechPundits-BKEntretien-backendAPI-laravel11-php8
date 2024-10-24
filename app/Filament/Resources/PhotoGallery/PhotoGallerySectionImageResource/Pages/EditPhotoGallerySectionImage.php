<?php

namespace App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotoGallerySectionImage extends EditRecord
{
    protected static string $resource = PhotoGallerySectionImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
