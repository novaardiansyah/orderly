<?php

namespace App\Filament\Resources\Generates\Tables;

use App\Models\Generate;
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

class GeneratesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')
          ->label(__('resources/generates.columns.name'))
          ->searchable()
          ->toggleable(),
        TextColumn::make('alias')
          ->label(__('resources/generates.columns.alias'))
          ->searchable()
          ->toggleable()
          ->copyable()
          ->badge()
          ->color('info'),
        TextColumn::make('prefix')
          ->label(__('resources/generates.columns.prefix'))
          ->searchable()
          ->toggleable()
          ->badge()
          ->color('info'),
        TextColumn::make('separator')
          ->label(__('resources/generates.columns.separator'))
          ->searchable()
          ->toggleable()
          ->badge()
          ->color('info'),
        TextColumn::make('queue')
          ->label(__('resources/generates.columns.queue'))
          ->numeric()
          ->sortable()
          ->toggleable()
          ->badge()
          ->color('info'),
        TextColumn::make('preview')
          ->label(__('resources/generates.columns.preview'))
          ->copyable()
          ->badge()
          ->color('info')
          ->toggleable()
          ->state(fn(Generate $record) => $record->getNextId()),
        TextColumn::make('deleted_at')
          ->label(__('resources/generates.columns.deleted_at'))
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('created_at')
          ->label(__('resources/generates.columns.created_at'))
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        TextColumn::make('updated_at')
          ->label(__('resources/generates.columns.updated_at'))
          ->dateTime()
          ->sortable()
          ->sinceTooltip()
          ->toggleable(isToggledHiddenByDefault: false),
      ])
      ->filters([
        TrashedFilter::make()
          ->native(false)
          ->preload()
          ->searchable(),
      ])
      ->defaultSort('updated_at', 'desc')
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
