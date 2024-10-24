<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery\PhotoGalleryResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhotoGalleries extends ListRecords
{
    protected static string $resource = PhotoGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
