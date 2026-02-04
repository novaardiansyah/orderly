<?php

namespace App\Filament\Resources\Generates\Schemas;

use App\Models\Generate;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GenerateInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/generates.sections.detail_description'))
          ->columns(3)
          ->columnSpan(['2xl' => 2])
          ->collapsible()
          ->schema([
            TextEntry::make('name')
              ->label(__('resources/generates.columns.name')),
            TextEntry::make('alias')
              ->label(__('resources/generates.columns.alias'))
              ->copyable()
              ->badge()
              ->color('info'),
            TextEntry::make('prefix')
              ->label(__('resources/generates.columns.prefix'))
              ->badge()
              ->color('info'),
            TextEntry::make('separator')
              ->label(__('resources/generates.columns.separator'))
              ->badge()
              ->color('info'),
            TextEntry::make('queue')
              ->label(__('resources/generates.columns.queue'))
              ->badge()
              ->color('info')
              ->numeric(),
            TextEntry::make('preview')
              ->label(__('resources/generates.columns.preview'))
              ->copyable()
              ->badge()
              ->color('info')
              ->state(fn(Generate $record) => $record->getNextId()),
          ]),

        Section::make()
          ->description(__('resources/generates.sections.timestamp_description'))
          ->columns(3)
          ->columnSpan(['2xl' => 1])
          ->collapsible()
          ->schema([
            TextEntry::make('created_at')
              ->label(__('resources/generates.columns.created_at'))
              ->dateTime()
              ->sinceTooltip(),
            TextEntry::make('updated_at')
              ->label(__('resources/generates.columns.updated_at'))
              ->dateTime()
              ->sinceTooltip(),
            TextEntry::make('deleted_at')
              ->label(__('resources/generates.columns.deleted_at'))
              ->dateTime()
              ->sinceTooltip(),
          ])
      ])
      ->columns([
        '2xl' => 3,
        'lg' => 1,
      ]);
  }
}
