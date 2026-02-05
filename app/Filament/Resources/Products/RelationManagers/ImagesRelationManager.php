<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImagesRelationManager extends RelationManager
{
  protected static string $relationship = 'images';

  public function form(Schema $schema): Schema
  {
    return $schema
      ->components([
        FileUpload::make('file_path')
          ->label(__('resources/product_images.columns.file_path'))
          ->image()
          ->disk('public')
          ->directory('images/products')
          ->required()
          ->maxSize(1024 * 5)
          ->imageEditor(),
        Textarea::make('description')
          ->label(__('resources/product_images.columns.description'))
          ->rows(3),
        Toggle::make('is_active')
          ->label(__('resources/product_images.columns.is_active'))
          ->required()
          ->default(true),
      ])
      ->columns(1);
  }

  public function infolist(Schema $schema): Schema
  {
    return $schema
      ->components([
        ImageEntry::make('file_path')
          ->label(__('resources/product_images.columns.file_path'))
          ->disk('public')
          ->width('100%')
          ->height('auto'),
        TextEntry::make('description')
          ->label(__('resources/product_images.columns.description')),
        IconEntry::make('is_active')
          ->label(__('resources/product_images.columns.is_active'))
          ->boolean(),
      ])
      ->columns(1);
  }

  public function table(Table $table): Table
  {
    return $table
      ->recordTitleAttribute('description')
      ->columns([
        ImageColumn::make('file_path')
          ->label(__('resources/product_images.columns.file_path'))
          ->disk('public')
          ->toggleable(),
        TextColumn::make('description')
          ->label(__('resources/product_images.columns.description'))
          ->searchable()
          ->toggleable(),
        IconColumn::make('is_active')
          ->label(__('resources/product_images.columns.is_active'))
          ->boolean()
          ->toggleable(),
        TextColumn::make('created_at')
          ->label(__('general.labels.created_at'))
          ->dateTime()
          ->sortable()
          ->sinceTooltip()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('updated_at')
          ->label(__('general.labels.updated_at'))
          ->dateTime()
          ->sortable()
          ->sinceTooltip()
          ->toggleable(),
        TextColumn::make('deleted_at')
          ->label(__('general.labels.deleted_at'))
          ->dateTime()
          ->sortable()
          ->sinceTooltip()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        TrashedFilter::make()
          ->searchable()
          ->preload()
          ->native(false),
      ])
      ->headerActions([
        CreateAction::make()
          ->label(__('resources/product_images.labels.create'))
          ->modalHeading(__('resources/product_images.labels.create'))
          ->modalWidth(Width::ExtraLarge),
      ])
      ->recordActions([
        ActionGroup::make([
          ViewAction::make()
            ->modalWidth(Width::ExtraLarge)
            ->slideOver(),
          EditAction::make()
            ->modalWidth(Width::ExtraLarge),
          DeleteAction::make(),
          ForceDeleteAction::make(),
          RestoreAction::make(),
        ])
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
          ForceDeleteBulkAction::make(),
          RestoreBulkAction::make(),
        ]),
      ])
      ->modifyQueryUsing(fn(Builder $query) => $query
        ->withoutGlobalScopes([
          SoftDeletingScope::class,
        ]));
  }
}
