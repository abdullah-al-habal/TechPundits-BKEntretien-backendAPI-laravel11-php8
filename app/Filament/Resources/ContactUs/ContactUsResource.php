<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactUs;

use App\Filament\Resources\ContactUs\ContactUsResource\Pages;
use App\Models\ContactUs;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactUsResource extends Resource
{
    protected static ?string $model = ContactUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Contact Us';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Contact Us';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Basic Information')
                        ->schema([
                            Forms\Components\FileUpload::make('banner_image')
                                ->required()
                                ->directory('ContactUs/Filament/BannerImages'),
                            Forms\Components\TextInput::make('banner_image_alt_text')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('banner_image_text')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('main_image')
                                ->required()
                                ->directory('ContactUs/Filament/MainImages'),
                            Forms\Components\TextInput::make('main_image_alt_text')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('main_image_text')
                                ->required()
                                ->maxLength(255),
                        ]),
                    Wizard\Step::make('Sections')
                        ->schema([
                            Repeater::make('sections')
                                ->relationship('sections')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\Textarea::make('content')
                                        ->required()
                                        ->columnSpanFull(),
                                ])
                                ->defaultItems(1)
                                ->addActionLabel('Add Section'),
                        ]),
                ])
                    ->skippable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactUs::route('/'),
            'create' => Pages\CreateContactUs::route('/create'),
            'edit' => Pages\EditContactUs::route('/{record}/edit'),
        ];
    }
}
