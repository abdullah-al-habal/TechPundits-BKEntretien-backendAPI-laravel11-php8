<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery\PhotoGalleryResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGalleryResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePhotoGallery extends CreateRecord
{
    protected static string $resource = PhotoGalleryResource::class;
}
