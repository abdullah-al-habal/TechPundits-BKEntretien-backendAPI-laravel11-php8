<?php

declare(strict_types=1);

namespace App\Services\HomePage;

use App\Exceptions\API\V1\HomePage\HomePageNotFoundException;
use App\Models\HomePage;
use App\Services\PhotoGallery\PhotoGallerySectionImageService;

class HomePageService
{
    public function __construct(
        private readonly PhotoGallerySectionImageService $imageService
    ) {}

    public function fetchHomePageData(): HomePage
    {
        $homePage = HomePage::with(['sections', 'faqs'])->first();

        if (!$homePage) {
            throw new HomePageNotFoundException();
        }

        $homePage->gallery_images = $this->imageService->getPhotoGallerySectionImages();

        return $homePage;
    }
}
