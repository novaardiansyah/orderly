<?php

namespace App\Filament\Resources\ProductSubCategories\Schemas;

use App\Models\ProductCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductSubCategoryForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/product_sub_categories.sections.general_description'))
          ->schema([
            Select::make('category_id')
              ->label(__('resources/product_sub_categories.columns.category_id'))
              ->options(ProductCategory::pluck('name', 'id'))
              ->required()
              ->searchable()
              ->preload()
              ->native(false),
            TextInput::make('name')
              ->label(__('resources/product_sub_categories.columns.name'))
              ->required()
              ->maxLength(255),
            Textarea::make('description')
              ->label(__('resources/product_sub_categories.columns.description'))
              ->rows(3)
              ->maxLength(1000),
          ]),
      ]);
  }
}
