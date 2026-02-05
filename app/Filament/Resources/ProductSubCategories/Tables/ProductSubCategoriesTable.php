<?php

namespace App\Filament\Resources\ProductSubCategories\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductSubCategoriesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('index')
          ->label(__('general.labels.row_index'))
          ->rowIndex(),
        TextColumn::make('category.name')
          ->label(__('resources/product_sub_categories.columns.category_id'))
          ->searchable()
          ->sortable()
          ->toggleable(),
        TextColumn::make('name')
          ->label(__('resources/product_sub_categories.columns.name'))
          ->searchable()
          ->sortable()
          ->toggleable(),
        TextColumn::make('description')
          ->label(__('resources/product_sub_categories.columns.description'))
          ->searchable()
          ->limit(100)
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
      ->recordActions([
        ActionGroup::make([
          ViewAction::make(),
          EditAction::make(),
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
      ]);
  }
}
