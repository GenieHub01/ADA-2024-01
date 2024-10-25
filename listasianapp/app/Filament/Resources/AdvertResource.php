<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvertResource\Pages;
use App\Models\Advert;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Http;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdvertResource extends Resource
{
    protected static ?string $model = Advert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('country_id')
                //     ->label('Country')
                //     ->options(function () {
                //         $response = Http::get(route('countries'));
                //         return $response->successful() ? $response->json() : [];
                //     })
                //     ->reactive()
                //     ->afterStateUpdated(fn ($state, callable $set) => $set('region_id', null))
                //     ->required(),

                // Select::make('region_id')
                //     ->label('Region')
                //     ->options(function ($get) {
                //         $countryId = $get('country_id');
                //         if ($countryId) {
                //             $response = Http::post(route('regions'), ['country_id' => $countryId]);
                //             return $response->successful() ? $response->json() : [];
                //         }
                //         return [];
                //     })
                //     ->reactive()
                //     ->afterStateUpdated(fn ($state, callable $set) => $set('city_id', null))
                //     ->required(),

                // Select::make('city_id')
                //     ->label('City')
                //     ->options(function ($get) {
                //         $countryId = $get('country_id');
                //         $regionId = $get('region_id');
                //         if ($countryId && $regionId) {
                //             $response = Http::post(route('cities'), ['country_id' => $countryId, 'region_id' => $regionId]);
                //             return $response->successful() ? $response->json() : [];
                //         }
                //         return [];
                //     })
                //     ->required(),

                Repeater::make('category')
                    ->relationship('categoriesMany')
                    ->label('Category')
                    ->schema([
                        SelectTree::make('parent_id')
                            ->relationship('parent', 'name', 'parent_id')
                            ->label('List Category')
                            ->placeholder(_('Please select a category'))
                            ->required(),
                    ]),
                    
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('postcode')
                    ->required(),

                TextInput::make('telephone')
                    ->required(),

                TextInput::make('mobile')
                    ->required(),

                TextInput::make('fax')
                    ->required(),
                
                TextInput::make('web')
                    ->required(),

                TextInput::make('email')
                    ->required(),
                
                TextInput::make('description')
                    ->required(),

                TextInput::make('facebook_url')
                    ->required(),
                
                TextInput::make('twitter_url')
                    ->required(),
                
                TextInput::make('instagram_url')
                    ->required(),
                
                TextInput::make('youtube_url')
                    ->required(),
                
                TextInput::make('pinterest_url')
                    ->required(),

                TextInput::make('seo_keywords')
                    ->required(),

                TextInput::make('seo_description')
                    ->required(),
    
                Select::make('package')
                    ->relationship('price', 'name')
                    ->label('Price')
                    ->required(),
                
                FileUpload::make('image')
                    ->label('Advert Image')
                    ->directory('adverts')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->size('small'),
                TextColumn::make('user.email')
                    ->label('User Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Advert Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('manager_name')
                    ->label('Manager Name')
                    ->sortable(),
                TextColumn::make('mobile')
                    ->label('Mobile')
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable(),
                TextColumn::make('telephone')
                    ->label('Telephone')
                    ->sortable(),
                IconColumn::make('seo1')
                    ->boolean()
                    ->label('SEO 1')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                IconColumn::make('seo2')
                    ->boolean()
                    ->label('SEO 2')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                IconColumn::make('active')
                    ->boolean()
                    ->label('Active')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                IconColumn::make('paid')
                    ->boolean()
                    ->label('Paid')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('expiry_date')
                    ->label('Expiry Date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                // Add any filter logic here
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
            'index' => Pages\ListAdverts::route('/'),
            'create' => Pages\CreateAdvert::route('/create'),
            'edit' => Pages\EditAdvert::route('/{record}/edit'),
        ];
    }
}
