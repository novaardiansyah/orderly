<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/customers.sections.detail_description'))
          ->collapsible()
          ->columns(['lg' => 3, '2xl' => 2])
          ->schema([
            TextEntry::make('code')
              ->label(__('resources/customers.columns.code'))
              ->badge()
              ->copyable(),
            TextEntry::make('name')
              ->label(__('resources/customers.columns.name')),
            TextEntry::make('phone')
              ->label(__('resources/customers.columns.phone'))
              ->placeholder('-'),
            IconEntry::make('is_member')
              ->label(__('resources/customers.columns.is_member'))
              ->boolean(),
            TextEntry::make('notes')
              ->label(__('resources/customers.columns.notes'))
              ->placeholder('-')
              ->columnSpan(['lg' => 2, '2xl' => 'full']),
          ]),

        Section::make()
          ->description(__('resources/customers.sections.timestamp_description'))
          ->collapsible()
          ->columns(3)
          ->schema([
            TextEntry::make('created_at')
              ->dateTime()
              ->sinceTooltip(),
            TextEntry::make('updated_at')
              ->dateTime()
              ->sinceTooltip(),
            TextEntry::make('deleted_at')
              ->dateTime()
              ->placeholder('-')
              ->sinceTooltip(),
          ]),
      ])
      ->columns(['lg' => 1, '2xl' => 2]);
  }
}
