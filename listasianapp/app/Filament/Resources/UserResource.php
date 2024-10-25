<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('f_name')
                    ->label('First Name')
                    ->required(),

                TextInput::make('l_name')
                    ->label('Last Name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->autocomplete('tel')
                    ->required(),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(),

                TextInput::make('password2')
                    ->label('Confirm Password')
                    ->password()
                    ->required(),

                TextInput::make('discount')
                    ->label('Discount')
                    ->numeric()
                    ->nullable(),

                DatePicker::make('expiry')
                    ->label('Expiry Date')
                    ->format('Y-m-d')
                    ->locale('id')
                    ->required(),

                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(10)
                    ->nullable(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('f_name')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('l_name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('discount')
                    ->label('Discount')
                    ->sortable()
                    ->numeric(),

                TextColumn::make('expiry')
                    ->label('Expiry Date')
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                // You can add custom filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
