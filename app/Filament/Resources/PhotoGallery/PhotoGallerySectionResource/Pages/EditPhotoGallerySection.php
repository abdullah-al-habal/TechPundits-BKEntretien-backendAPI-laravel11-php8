<?php

namespace App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotoGallerySection extends EditRecord
{
    protected static string $resource = PhotoGallerySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
