<?php

declare(strict_types=1);

namespace App\Filament\Resources\Unlocking\UnlockingResource\Pages;

use App\Filament\Resources\Unlocking\UnlockingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUnlocking extends CreateRecord
{
    protected static string $resource = UnlockingResource::class;
}
