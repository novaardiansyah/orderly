<?php

namespace App\Filament\Resources\ProductSubCategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductSubCategoryInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/product_sub_categories.sections.general_description'))
          ->columnSpan(1)
          ->columns(3)
          ->collapsible()
          ->schema([
            TextEntry::make('category.name')
              ->label(__('resources/product_sub_categories.columns.category_id')),
            TextEntry::make('name')
              ->label(__('resources/product_sub_categories.columns.name')),
            TextEntry::make('description')
              ->label(__('resources/product_sub_categories.columns.description')),
          ]),

        Section::make()
          ->description(__('general.labels.timestamps_description'))
          ->columns(3)
          ->collapsible()
          ->schema([
            TextEntry::make('created_at')
              ->label(__('general.labels.created_at'))
              ->dateTime()
              ->sinceTooltip(),
            TextEntry::make('updated_at')
              ->label(__('general.labels.updated_at'))
              ->dateTime()
              ->sinceTooltip(),
            TextEntry::make('deleted_at')
              ->label(__('general.labels.deleted_at'))
              ->dateTime()
              ->sinceTooltip(),
          ])
      ])
      ->columns(2);
  }
}
