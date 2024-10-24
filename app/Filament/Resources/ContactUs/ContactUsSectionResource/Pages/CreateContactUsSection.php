<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactUs\ContactUsSectionResource\Pages;

use App\Filament\Resources\ContactUs\ContactUsSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactUsSection extends CreateRecord
{
    protected static string $resource = ContactUsSectionResource::class;
}
