<?php

declare(strict_types=1);

namespace App\Services\HomePage;

use App\Exceptions\API\V1\HomePage\HomePageNotFoundException;
use App\Models\HomePage;

class HomePageService
{
    public function getHomePage(): HomePage
    {
        $homePage = HomePage::with([
            'sections',
            'faqs',
        ])->first();

        if (! $homePage) {
            throw new HomePageNotFoundException();
        }

        return $homePage;
    }
}
