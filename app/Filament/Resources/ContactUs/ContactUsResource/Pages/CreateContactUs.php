<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactUs\ContactUsResource\Pages;

use App\Filament\Resources\ContactUs\ContactUsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactUs extends CreateRecord
{
    protected static string $resource = ContactUsResource::class;
}
