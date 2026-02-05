<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/products.sections.general_description'))
          ->columns(2)
          ->schema([
            TextEntry::make('code')
              ->label(__('resources/products.columns.code'))
              ->badge()
              ->copyable(),
            TextEntry::make('name')
              ->label(__('resources/products.columns.name')),
            TextEntry::make('category.name')
              ->label(__('resources/products.columns.category')),
            TextEntry::make('subCategory.name')
              ->label(__('resources/products.columns.sub_category')),
          ]),

        Section::make()
          ->description(__('resources/products.sections.pricing_stock_description'))
          ->columns(3)
          ->schema([
            TextEntry::make('sell_price')
              ->label(__('resources/products.columns.sell_price'))
              ->formatStateUsing(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0))),
            TextEntry::make('cost_price')
              ->label(__('resources/products.columns.cost_price'))
              ->formatStateUsing(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0))),
            TextEntry::make('stock')
              ->label(__('resources/products.columns.stock'))
              ->formatStateUsing(fn(?string $state) => formatQuantity((float) ($state ?? 0), 0, '')),
          ]),

        Section::make()
          ->description(__('general.labels.timestamps_description'))
          ->columns(3)
          ->schema([
            TextEntry::make('created_at')
              ->label(__('general.labels.created_at'))
              ->dateTime()
              ->placeholder('-'),
            TextEntry::make('updated_at')
              ->label(__('general.labels.updated_at'))
              ->dateTime()
              ->placeholder('-'),
            TextEntry::make('deleted_at')
              ->label(__('general.labels.deleted_at'))
              ->dateTime()
              ->placeholder('-'),
          ])
      ]);
  }
}
