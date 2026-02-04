<?php

namespace App\Filament\Resources\Generates\Schemas;

use App\Filament\Resources\Generates\Actions\GenerateAction;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GenerateForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->columns(2)
          ->description(__('resources/generates.sections.format_description'))
          ->collapsible()
          ->schema([
            TextInput::make('prefix')
              ->label(__('resources/generates.columns.prefix'))
              ->required()
              ->maxLength(5)
              ->live(onBlur: true)
              ->afterStateUpdated(fn(callable $set, callable $get) => self::handleReviewID($set, $get)),
            TextInput::make('separator')
              ->label(__('resources/generates.columns.separator'))
              ->readOnly()
              ->default(now()->format('ymd')),
            TextInput::make('queue')
              ->label(__('resources/generates.columns.queue'))
              ->required()
              ->numeric()
              ->minValue(1)
              ->default(1)
              ->maxValue(999999)
              ->live(onBlur: true)
              ->afterStateUpdated(fn(callable $set, callable $get) => self::handleReviewID($set, $get)),
            TextInput::make('next_id')
              ->label(__('resources/generates.columns.preview'))
              ->disabled(),
          ]),

        Section::make()
          ->columns(2)
          ->description(__('resources/generates.sections.basic_description'))
          ->collapsible()
          ->schema([
            TextInput::make('name')
              ->label(__('resources/generates.columns.name'))
              ->required()
              ->maxLength(255)
              ->live(onBlur: true)
              ->afterStateUpdated(fn(callable $set, callable $get) => self::handleAlias($set, $get)),
            TextInput::make('alias')
              ->label(__('resources/generates.columns.alias'))
              ->required()
              ->maxLength(25),
          ]),
      ]);
  }

  public static function handleReviewID(callable $set, callable $get): void
  {
    $prefix    = $get('prefix');
    $separator = $get('separator');
    $queue     = $get('queue');

    $result = GenerateAction::getReviewID($prefix, $separator, $queue);

    if ($result) {
      $set('next_id', $result);
    }
  }

  public static function handleAlias(callable $set, callable $get): void
  {
    $name = $get('name');

    if ($name) {
      $set('alias', str()->slug($name, '_'));
    }
  }
}
