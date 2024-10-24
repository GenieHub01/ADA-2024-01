<?php

namespace App\Filament\Resources\PackagePriceResource\Pages;

use App\Filament\Resources\PackagePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackagePrices extends ListRecords
{
    protected static string $resource = PackagePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
