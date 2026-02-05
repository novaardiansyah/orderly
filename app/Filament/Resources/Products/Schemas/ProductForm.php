<?php

/*
 * Project Name: orderly
 * File: ProductForm.php
 * Created Date: Wednesday February 4th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/products.sections.general_description'))
          ->columns(2)
          ->schema([
            TextInput::make('name')
              ->label(__('resources/products.columns.name'))
              ->required(),
            Select::make('category_id')
              ->label(__('resources/products.columns.category'))
              ->relationship('category', 'name')
              ->required()
              ->searchable()
              ->preload()
              ->native(false),
          ]),

        Section::make()
          ->description(__('resources/products.sections.pricing_stock_description'))
          ->columns(3)
          ->schema([
            TextInput::make('sell_price')
              ->label(__('resources/products.columns.sell_price'))
              ->required()
              ->numeric()
              ->default(0)
              ->prefix('Rp')
              ->live(onBlur: true)
              ->hint(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0))),
            TextInput::make('cost_price')
              ->label(__('resources/products.columns.cost_price'))
              ->required()
              ->numeric()
              ->default(0)
              ->prefix('Rp')
              ->live(onBlur: true)
              ->hint(fn(?string $state) => toIndonesianCurrency((float) ($state ?? 0))),
            TextInput::make('stock')
              ->label(__('resources/products.columns.stock'))
              ->required()
              ->numeric()
              ->default(0)
              ->suffix('Pcs')
              ->live(onBlur: true)
              ->hint(fn(?string $state) => formatQuantity((float) ($state ?? 0), 0, '')),
          ])
      ]);
  }
}
