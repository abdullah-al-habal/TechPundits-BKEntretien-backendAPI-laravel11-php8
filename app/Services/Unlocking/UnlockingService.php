<?php

declare(strict_types=1);

namespace App\Services\Unlocking;

use App\Exceptions\API\V1\Unlocking\UnlockingNotFoundException;
use App\Models\Unlocking;
use Illuminate\Pagination\LengthAwarePaginator;

class UnlockingService
{
    public function getUnlockings(int $perPage = 15): LengthAwarePaginator
    {
        $unlockings = Unlocking::with('sections')->paginate(perPage: $perPage);

        if ($unlockings->isEmpty()) {
            throw new UnlockingNotFoundException();
        }

        return $unlockings;
    }
}
