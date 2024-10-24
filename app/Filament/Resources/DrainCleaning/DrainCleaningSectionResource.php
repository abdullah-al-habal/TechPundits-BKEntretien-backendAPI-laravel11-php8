<?php

namespace App\Filament\Resources\DrainCleaning;

use App\Filament\Resources\DrainCleaning\DrainCleaningSectionResource\Pages;
use App\Filament\Resources\DrainCleaning\DrainCleaningSectionResource\RelationManagers;
use App\Models\DrainCleaning\DrainCleaningSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DrainCleaningSectionResource extends Resource
{
    protected static ?string $model = DrainCleaningSection::class;

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
            'index' => Pages\ListDrainCleaningSections::route('/'),
            'create' => Pages\CreateDrainCleaningSection::route('/create'),
            'edit' => Pages\EditDrainCleaningSection::route('/{record}/edit'),
        ];
    }
}
