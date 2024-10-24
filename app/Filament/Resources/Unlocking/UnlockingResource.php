<?php

declare(strict_types=1);

namespace App\Filament\Resources\Unlocking;

use App\Filament\Resources\Unlocking\UnlockingResource\Pages;
use App\Models\Unlocking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UnlockingResource extends Resource
{
    protected static ?string $model = Unlocking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Unlocking';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Unlocking';

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
                Forms\Components\FileUpload::make('main_image')
                    ->required(),
                Forms\Components\TextInput::make('main_image_alt_text')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('main_image_text')
                    ->required()
                    ->maxLength(255),
            ])
        ;
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
            'index' => Pages\ListUnlockings::route('/'),
            'create' => Pages\CreateUnlocking::route('/create'),
            'edit' => Pages\EditUnlocking::route('/{record}/edit'),
        ];
    }
}
