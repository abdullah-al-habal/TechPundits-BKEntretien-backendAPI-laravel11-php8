<?php

declare(strict_types=1);

namespace App\Filament\Resources\DrainCleaning;

use App\Filament\Resources\DrainCleaning\DrainCleaningResource\Pages;
use App\Models\DrainCleaning;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DrainCleaningResource extends Resource
{
    protected static ?string $model = DrainCleaning::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Drain Cleaning';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Drain Cleaning';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('banner_image')
                    ->required(),
                Forms\Components\TextInput::make('banner_image_alt_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('banner_image_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('first_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('second_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('main_image')
                    ->required(),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_description')
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
