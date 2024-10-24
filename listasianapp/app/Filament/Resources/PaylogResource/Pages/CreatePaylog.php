<?php

namespace App\Filament\Resources\PaylogResource\Pages;

use App\Filament\Resources\PaylogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaylog extends CreateRecord
{
    protected static string $resource = PaylogResource::class;
}
