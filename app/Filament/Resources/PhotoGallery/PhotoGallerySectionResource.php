<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionResource\Pages;
use App\Models\PhotoGallerySection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PhotoGallerySectionResource extends Resource
{
    protected static ?string $model = PhotoGallerySection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Photo Gallery';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Gallery Sections';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotoGallerySections::route('/'),
            'create' => Pages\CreatePhotoGallerySection::route('/create'),
            'edit' => Pages\EditPhotoGallerySection::route('/{record}/edit'),
        ];
    }
}
