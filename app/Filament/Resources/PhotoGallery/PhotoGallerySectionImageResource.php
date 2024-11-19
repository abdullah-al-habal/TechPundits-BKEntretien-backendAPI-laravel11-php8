<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoGallery;

use App\Filament\Resources\PhotoGallery\PhotoGallerySectionImageResource\Pages;
use App\Models\PhotoGallerySectionImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PhotoGallerySectionImageResource extends Resource
{
    protected static ?string $model = PhotoGallerySectionImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Photo Gallery';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Section Images';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->required()
                    ->directory('PhotoGallery/Filament/SectionImages'),
                Forms\Components\TextInput::make('alt_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('alt_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
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
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
