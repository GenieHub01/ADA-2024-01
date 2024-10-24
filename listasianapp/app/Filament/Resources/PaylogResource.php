<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaylogResource\Pages;
use App\Filament\Resources\PaylogResource\RelationManagers;
use App\Models\Paylog;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaylogResource extends Resource
{
    protected static ?string $model = Paylog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->label('User ID')
                    ->required()
                    ->numeric()
                    ->disabled(),
                
                TextInput::make('advert_id')
                    ->label('Advert ID')
                    ->required()
                    ->numeric(),
                    
                TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->maxLength(10),
                    
                // DateTimePicker::make('create_time')
                //     ->label('Create Time')
                //     ->required()
                //     ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email')
                    ->label('User Email')
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('advert_id')
                    ->label('Advert ID')
                    ->sortable()
                    ->searchable()
                    ->width('4%'),
                
                TextColumn::make('amount')
                    ->label('Amount')
                    ->sortable()
                    ->searchable()
                    ->width('4%'),
                
                TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->searchable(),
                
                // TextColumn::make('create_time')
                //     ->label('Create Time')
                //     ->sortable()
                //     ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('Y-m-d H:i:s')),
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
            'index' => Pages\ListPaylogs::route('/'),
            'create' => Pages\CreatePaylog::route('/create'),
            'edit' => Pages\EditPaylog::route('/{record}/edit'),
        ];
    }
}
