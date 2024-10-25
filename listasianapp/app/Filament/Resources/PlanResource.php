<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use App\Models\Price;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Name'),
                    
                Select::make('package')
                    ->label('Package')
                    ->options(Price::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Select::make('interval')
                    ->label('Interval')
                    ->options([
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                    ])
                    ->required(),

                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->label('Amount'),

                TextInput::make('currency')
                    ->required()
                    ->label('Currency'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name'),

                TextColumn::make('package')
                    ->label('Package')
                    ->formatStateUsing(function ($record) {
                        return Price::find($record->package)->name;
                    }),

                TextColumn::make('interval')
                    ->label('Interval')
                    ->formatStateUsing(function ($record) {
                        $intervals = [
                            'daily' => 'Daily',
                            'weekly' => 'Weekly',
                            'monthly' => 'Monthly',
                        ];
                        return $intervals[$record->interval] ?? 'Unknown';
                    }),

                TextColumn::make('amount')
                    ->label('Amount'),

                TextColumn::make('currency')
                    ->label('Currency'),
            ])
            ->filters([
                // Add any relevant filters here
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
