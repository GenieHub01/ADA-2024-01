<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackagePriceResource\Pages;
use App\Filament\Resources\PackagePriceResource\RelationManagers;
use App\Models\PackagePrice;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ButtonAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackagePriceResource extends Resource
{
    protected static ?string $model = PackagePrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            // Select::make('country_id')
            //     ->label('Country')
            //     ->options(\App\Models\Geo::getCountries()) // assuming Geo::getCountries() returns a list of countries
            //     ->reactive()
            //     ->afterStateUpdated(function (callable $set, $state) {
            //         $set('region_id', null);
            //         $set('sub_region_id', null);
            //     })
            //     ->searchable()
            //     ->placeholder('Select country'),

            // Select::make('region_id')
            //     ->label('Region')
            //     ->options(function (callable $get) {
            //         $countryId = $get('country_id');
            //         return $countryId ? \App\Models\Geo::getRegions($countryId) : [];
            //     })
            //     ->reactive()
            //     ->afterStateUpdated(function (callable $set, $state) {
            //         $set('sub_region_id', null);
            //     })
            //     ->searchable()
            //     ->placeholder('Select region'),

            // Select::make('sub_region_id')
            //     ->label('Sub Region')
            //     ->options(function (callable $get) {
            //         $regionId = $get('region_id');
            //         return $regionId ? \App\Models\SubRegion::where('region_id', $regionId)->pluck('name', 'id')->toArray() : [];
            //     })
            //     ->searchable()
            //     ->placeholder('None'),

            TextInput::make('price_1')
                ->label('Price 1')
                ->numeric()
                ->required(),

            TextInput::make('price_2')
                ->label('Price 2')
                ->numeric(),

            TextInput::make('price_3')
                ->label('Price 3')
                ->numeric(),

            Action::make('Save')
                ->type('submit')
                ->label('Save')
                ->icon('heroicon-o-check'),
        ]);
    }


    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            // TextColumn::make('country.name')
            //     ->label('Country')
            //     ->sortable()
            //     ->searchable(),
            // TextColumn::make('region_name')
            //     ->label('Region')
            //     ->sortable(),
            // TextColumn::make('sub_region.name')
            //     ->label('Sub Region')
            //     ->sortable()
            //     ->formatStateUsing(function ($state, $record) {
            //         return $record->sub_region_id ? $record->subRegion->name : 'none';
            //     }),
            TextColumn::make('price_1')
                ->label('Price 1')
                ->sortable()
                ->size('small'),
            TextColumn::make('price_2')
                ->label('Price 2')
                ->sortable()
                ->size('small'),
            TextColumn::make('price_3')
                ->label('Price 3')
                ->sortable()
                ->size('small'),
            TextColumn::make('advert_count')
                ->label('Count')
                ->getStateUsing(function ($record) {
                    return \App\Models\Advert::where('country_id', $record->country_id)
                        ->where('region_id', $record->region_id)
                        ->where('sub_region_id', $record->sub_region_id)
                        ->count();
                }),
        ])
        ->filters([
            // SelectFilter::make('country_id')
            //     ->relationship('country', 'name')
            //     ->label('Country')
            //     ->placeholder('All Countries'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackagePrices::route('/'),
            'create' => Pages\CreatePackagePrice::route('/create'),
            'edit' => Pages\EditPackagePrice::route('/{record}/edit'),
        ];
    }
}
