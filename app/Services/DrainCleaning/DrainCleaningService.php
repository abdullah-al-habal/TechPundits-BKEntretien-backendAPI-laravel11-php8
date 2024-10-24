<?php

declare(strict_types=1);

namespace App\Services\DrainCleaning;

use App\Exceptions\API\V1\DrainCleaning\DrainCleaningNotFoundException;
use App\Models\DrainCleaning;
use Illuminate\Pagination\LengthAwarePaginator;

class DrainCleaningService
{
    public function getDrainCleanings(int $perPage = 15): LengthAwarePaginator
    {
        $drainCleanings = DrainCleaning::with('sections')->paginate(perPage: $perPage);

        if ($drainCleanings->isEmpty()) {
            throw new DrainCleaningNotFoundException();
        }

        return $drainCleanings;
    }
}
