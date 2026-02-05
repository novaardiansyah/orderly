<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductCategoryForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/product_categories.sections.general_description'))
          ->schema([
            TextInput::make('name')
              ->label(__('resources/product_categories.columns.name'))
              ->required()
              ->maxLength(255),
            Textarea::make('description')
              ->label(__('resources/product_categories.columns.description'))
              ->rows(3)
              ->required()
              ->maxLength(1000),
          ]),
      ]);
  }
}
