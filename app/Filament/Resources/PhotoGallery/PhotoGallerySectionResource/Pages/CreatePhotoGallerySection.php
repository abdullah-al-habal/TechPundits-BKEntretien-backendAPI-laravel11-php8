<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource\Pages;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePhotoGallerySection extends CreateRecord
{
    protected static string $resource = PhotoGallerySectionResource::class;
}
