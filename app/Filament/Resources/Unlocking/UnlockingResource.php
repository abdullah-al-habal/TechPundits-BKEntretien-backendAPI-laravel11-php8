<?php

namespace App\Filament\Resources\Unlocking;

use App\Filament\Resources\Unlocking\UnlockingResource\Pages;
use App\Filament\Resources\Unlocking\UnlockingResource\RelationManagers;
use App\Models\Unlocking\Unlocking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnlockingResource extends Resource
{
    protected static ?string $model = Unlocking::class;

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
            'index' => Pages\ListUnlockings::route('/'),
            'create' => Pages\CreateUnlocking::route('/create'),
            'edit' => Pages\EditUnlocking::route('/{record}/edit'),
        ];
    }
}
