<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhotoGallerySections extends ListRecords
{
    protected static string $resource = PhotoGallerySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
