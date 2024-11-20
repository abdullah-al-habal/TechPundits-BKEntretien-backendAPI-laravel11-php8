<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    require __DIR__ . '/site-settings.php';

    require __DIR__ . '/contact-us.php';

    require __DIR__ . '/testimonials.php';

    require __DIR__ . '/photo-gallery.php';

    require __DIR__ . '/drain-cleaning.php';

    require __DIR__ . '/unlocking.php';

    require __DIR__ . '/home-page.php';

    require __DIR__ . '/faqs.php';
});
