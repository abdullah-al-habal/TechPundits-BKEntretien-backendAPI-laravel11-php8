<?php

declare(strict_types=1);

namespace App\Filament\Resources\HomePage;

use App\Filament\Resources\HomePage\HomePageResource\Pages;
use App\Filament\Resources\HomePage\HomePageResource\RelationManagers;
use App\Models\HomePage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomePageResource extends Resource
{
    protected static ?string $model = HomePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Home Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('banner_image')
                    ->required()
                    ->directory('HomePage/Filament/BannerImages'),
                Forms\Components\TextInput::make('banner_image_alt_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('banner_image_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('main_image')
                    ->required()
                    ->directory('HomePage/Filament/MainImages'),
                Forms\Components\TextInput::make('main_image_alt_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('main_image_text')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner_image'),
                Tables\Columns\TextColumn::make('banner_image_text')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('main_image'),
                Tables\Columns\TextColumn::make('main_image_text')
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
            // RelationManagers\SectionsRelationManager::class,
            // RelationManagers\FaqsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomePages::route('/'),
            'create' => Pages\CreateHomePage::route('/create'),
            'edit' => Pages\EditHomePage::route('/{record}/edit'),
        ];
    }
}
