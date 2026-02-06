<?php

namespace App\Filament\Resources\Orders\Tables;

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

class OrdersTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('index')
          ->label(__('general.labels.row_index'))
          ->rowIndex(),
        TextColumn::make('code')
          ->label(__('resources/orders.columns.code'))
          ->searchable()
          ->toggleable()
          ->copyable()
          ->badge(),
        TextColumn::make('quantity')
          ->label(__('resources/orders.columns.quantity'))
          ->formatStateUsing(fn(?string $state) => formatQuantity((float) ($state ?? 0), 0, ''))
          ->sortable()
          ->toggleable(),
        TextColumn::make('total_price')
          ->label(__('resources/orders.columns.total_price'))
          ->formatStateUsing(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0)))
          ->sortable()
          ->toggleable(),
        TextColumn::make('status')
          ->label(__('resources/orders.columns.status'))
          ->badge()
          ->toggleable(),
        TextColumn::make('payment_method')
          ->label(__('resources/orders.columns.payment_method'))
          ->badge()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('payment_status')
          ->label(__('resources/orders.columns.payment_status'))
          ->toggleable(),
        TextColumn::make('notes')
          ->label(__('resources/orders.columns.notes'))
          ->limit(100)
          ->searchable()
          ->toggleable(isToggledHiddenByDefault: true),
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
