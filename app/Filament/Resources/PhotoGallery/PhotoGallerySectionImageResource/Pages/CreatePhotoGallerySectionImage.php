<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePhotoGallerySectionImage extends CreateRecord
{
    protected static string $resource = PhotoGallerySectionImageResource::class;
}
