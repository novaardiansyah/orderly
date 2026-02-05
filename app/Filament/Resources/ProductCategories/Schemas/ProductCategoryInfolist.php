<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductCategoryInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/product_categories.sections.general_description'))
          ->columnSpan(1)
          ->columns(3)
          ->collapsible()
          ->schema([
            TextEntry::make('name')
              ->label(__('resources/product_categories.columns.name')),
            TextEntry::make('description')
              ->label(__('resources/product_categories.columns.description'))
              ->columnSpan(2),
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
