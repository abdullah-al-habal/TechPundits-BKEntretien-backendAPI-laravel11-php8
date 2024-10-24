<?php

declare(strict_types=1);

namespace App\Filament\Resources\Unlocking\UnlockingSectionResource\Pages;

use App\Filament\Resources\Unlocking\UnlockingSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUnlockingSection extends CreateRecord
{
    protected static string $resource = UnlockingSectionResource::class;
}
