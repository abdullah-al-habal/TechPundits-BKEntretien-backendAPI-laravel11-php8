<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface FaqServiceInterface
{
    public function getFaqs(): Collection;
}
