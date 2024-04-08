<?php

namespace AdminKit\Vacancy\UI\Filament\Resources;

use AdminKit\Core\Forms\Components\TranslatableTabs;
use AdminKit\Vacancy\Models\Vacancy;
use AdminKit\Vacancy\UI\Filament\Resources\VacancyResource\Pages;
use AdminKit\Vacancy\UI\Filament\Resources\VacancyResource\RelationManagers\VacancyGalleryRelationManager;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class VacancyResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\SpatieMediaLibraryFileUpload::make('background')
                    ->label(__('admin-kit-vacancy::vacancy.resource.image'))
                    ->collection('main')
                    ->image()
                    ->columnSpan(2)
                    ->required()
                    ->optimize('webp')
                    ->resize(30),
                TranslatableTabs::make(fn ($locale) => Forms\Components\Tabs\Tab::make($locale)->schema([
                    Forms\Components\TextInput::make('title.'.$locale)
                        ->label(__('admin-kit-vacancy::vacancy.resource.title'))
                        ->required($locale === app()->getLocale()),
                    Forms\Components\TextInput::make('subtitle.'.$locale)
                        ->label(__('admin-kit-vacancy::vacancy.resource.subtitle'))
                        ->required($locale === app()->getLocale()),
                    Forms\Components\Section::make(__('admin-kit-vacancy::vacancy.resource.action_button'))->schema([
                        Forms\Components\TextInput::make('action_title.'.$locale)
                            ->label(__('admin-kit-vacancy::vacancy.resource.title')),
                        Forms\Components\TextInput::make('action_link.'.$locale)
                            ->label(__('admin-kit-vacancy::vacancy.resource.link')),
                    ])->columns(2),
                ])),
            ])
            ->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin-kit-vacancy::vacancy.resource.id'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin-kit-vacancy::vacancy.resource.title')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin-kit-vacancy::vacancy.resource.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            VacancyGalleryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CreateVacancy::route('/'),
            'edit' => Pages\EditVacancy::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('admin-kit-vacancy::vacancy.resource.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin-kit-vacancy::vacancy.resource.plural_label');
    }

    public static function getNavigationUrl(): string
    {
        $vacancy = Vacancy::query()
            ->first();

        return $vacancy
            ? self::getUrl('edit', ['record' => $vacancy])
            : self::getUrl();
    }
}
