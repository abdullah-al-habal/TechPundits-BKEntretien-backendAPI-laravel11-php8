<?php

namespace App\Filament\Resources\PhotoGallery;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource\Pages;
use App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource\RelationManagers;
use App\Models\PhotoGallery\PhotoGallerySectionImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoGallerySectionImageResource extends Resource
{
    protected static ?string $model = PhotoGallerySectionImage::class;

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
            'index' => Pages\ListPhotoGallerySectionImages::route('/'),
            'create' => Pages\CreatePhotoGallerySectionImage::route('/create'),
            'edit' => Pages\EditPhotoGallerySectionImage::route('/{record}/edit'),
        ];
    }
}
