<?php

namespace App\Filament\Resources\PaylogResource\Pages;

use App\Filament\Resources\PaylogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaylog extends EditRecord
{
    protected static string $resource = PaylogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
