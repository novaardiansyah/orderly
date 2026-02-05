<?php

/*
 * Project Name: orderly
 * File: ProductsTable.php
 * Created Date: Wednesday February 4th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Filament\Resources\Products\Tables;

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
        TextColumn::make('category.name')
          ->label(__('resources/products.columns.category'))
          ->searchable()
          ->sortable()
          ->toggleable()
          ->badge(),
        TextColumn::make('subCategory.name')
          ->label(__('resources/products.columns.sub_category'))
          ->searchable()
          ->sortable()
          ->toggleable()
          ->badge(),
        TextColumn::make('sell_price')
          ->label(__('resources/products.columns.sell_price'))
          ->formatStateUsing(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0)))
          ->sortable()
          ->toggleable(),
        TextColumn::make('cost_price')
          ->label(__('resources/products.columns.cost_price'))
          ->formatStateUsing(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0)))
          ->sortable()
          ->toggleable(),
        TextColumn::make('stock')
          ->label(__('resources/products.columns.stock'))
          ->formatStateUsing(fn(?string $state) => formatQuantity((float) ($state ?? 0), 0, ''))
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
