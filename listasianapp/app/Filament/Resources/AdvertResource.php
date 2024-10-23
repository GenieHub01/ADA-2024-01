<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvertResource\Pages;
use App\Filament\Resources\AdvertResource\RelationManagers;
use App\Models\Advert;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvertResource extends Resource
{
    protected static ?string $model = Advert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('user_id')
                //     ->relationship('user', 'name')
                //     ->label('User')
                //     ->required(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
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

                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('postcode')
                    ->required(),
                
                // Select::make('country')
                //     ->relationship('country', 'name')
                //     ->label('Country')
                //     ->required(),

                // Select::make('region')
                //     ->relationship('subRegion', 'name')
                //     ->label('Sub Region')
                //     ->required(),

                // Select::make('sub_region')
                //     ->relationship('subRegion', 'name')
                //     ->label('Sub Region')
                //     ->required(),

                // Select::make('city')
                //     ->relationship('subRegion', 'name')
                //     ->label('Sub Region')
                //     ->required(),

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
                    ->label('Price Package')
                    ->required(),
                
                // FileUpload::make('image')
                //     ->label('Advert Image')
                //     ->directory('adverts')
                //     ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('name')
                //     ->label('Advert Name')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('user.name')
                //     ->label('User')
                //     ->sortable(),
                // IconColumn::make('active')
                //     ->boolean()
                //     ->label('Active')
                //     ->trueIcon('heroicon-o-badge-check')
                //     ->falseIcon('heroicon-o-x-circle'),
                // IconColumn::make('paid')
                //     ->boolean()
                //     ->label('Paid')
                //     ->trueIcon('heroicon-o-badge-check')
                //     ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
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
