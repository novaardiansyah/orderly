<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/customers.sections.detail_description'))
          ->schema([
            TextInput::make('name')
              ->label(__('resources/customers.columns.name'))
              ->maxLength(255)
              ->required(),
            TextInput::make('phone')
              ->label(__('resources/customers.columns.phone'))
              ->maxLength(15)
              ->tel(),
            Textarea::make('notes')
              ->label(__('resources/customers.columns.notes'))
              ->maxLength(1000)
              ->rows(3),
            Toggle::make('is_member')
              ->label(__('resources/customers.columns.is_member'))
              ->default(false),
          ]),
      ]);
  }
}
