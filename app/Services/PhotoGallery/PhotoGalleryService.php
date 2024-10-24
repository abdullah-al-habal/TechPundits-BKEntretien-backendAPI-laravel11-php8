<?php

declare(strict_types=1);

namespace App\Services\PhotoGallery;

use App\Exceptions\API\V1\PhotoGallery\PhotoGalleryNotFoundException;
use App\Models\PhotoGallery;
use Illuminate\Pagination\LengthAwarePaginator;

class PhotoGalleryService
{
    public function getPhotoGalleries(int $perPage = 15): LengthAwarePaginator
    {
        $photoGalleries = PhotoGallery::with([
            'sections' => static function ($query): void {
                $query->with('images');
            },
        ])->paginate(perPage: $perPage);

        if ($photoGalleries->isEmpty()) {
            throw new PhotoGalleryNotFoundException();
        }

        return $photoGalleries;
    }
}
