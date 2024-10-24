<?php

namespace App\Filament\Resources\DrainCleaning;

use App\Filament\Resources\DrainCleaning\DrainCleaningResource\Pages;
use App\Filament\Resources\DrainCleaning\DrainCleaningResource\RelationManagers;
use App\Models\DrainCleaning\DrainCleaning;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DrainCleaningResource extends Resource
{
    protected static ?string $model = DrainCleaning::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListDrainCleanings::route('/'),
            'create' => Pages\CreateDrainCleaning::route('/create'),
            'edit' => Pages\EditDrainCleaning::route('/{record}/edit'),
        ];
    }
}
