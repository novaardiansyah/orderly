<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('index')
          ->label(__('general.labels.row_index'))
          ->rowIndex(),
        TextColumn::make('code')
          ->label(__('resources/products.columns.code'))
          ->searchable()
          ->toggleable()
          ->copyable()
          ->badge(),
        TextColumn::make('name')
          ->label(__('resources/products.columns.name'))
          ->searchable()
          ->toggleable(),
        TextColumn::make('sell_price')
          ->label(__('resources/products.columns.sell_price'))
          ->money()
          ->sortable()
          ->toggleable(),
        TextColumn::make('cost_price')
          ->label(__('resources/products.columns.cost_price'))
          ->money()
          ->sortable()
          ->toggleable(),
        TextColumn::make('stock')
          ->label(__('resources/products.columns.stock'))
          ->numeric()
          ->sortable()
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
        ViewAction::make(),
        EditAction::make(),
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
