<?php

declare(strict_types=1);

namespace App\Filament\Resources\Faq\FaqResource\Pages;

use App\Filament\Resources\Faq\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
