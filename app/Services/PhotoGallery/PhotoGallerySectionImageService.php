<?php

declare(strict_types=1);

namespace App\Services\PhotoGallery;

use App\Models\PhotoGallerySectionImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PhotoGallerySectionImageService
{
    public function getPhotoGallerySectionImages(): Collection
    {
        try {
            return PhotoGallerySectionImage::all();
        } catch (\Exception $e) {
            Log::error('Failed to fetch PhotoGallerySectionImages: ' . $e->getMessage());

            return collect();
        }
    }
}
