<?php

namespace App\Filament\Resources\HomePage;

use App\Filament\Resources\HomePage\HomePageSectionResource\Pages;
use App\Filament\Resources\HomePage\HomePageSectionResource\RelationManagers;
use App\Models\HomePage\HomePageSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomePageSectionResource extends Resource
{
    protected static ?string $model = HomePageSection::class;

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
            'index' => Pages\ListHomePageSections::route('/'),
            'create' => Pages\CreateHomePageSection::route('/create'),
            'edit' => Pages\EditHomePageSection::route('/{record}/edit'),
        ];
    }
}
