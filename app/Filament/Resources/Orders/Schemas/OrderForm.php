<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\OrderStatusEnum;
use App\PaymentMethodEnum;
use App\PaymentStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make()
          ->description(__('resources/orders.sections.detail_description'))
          ->collapsible()
          ->schema([
            TextInput::make('name')
              ->label(__('resources/orders.labels.customer_name'))
              ->maxLength(255)
              ->required(),
            TextInput::make('phone')
              ->label(__('resources/orders.labels.customer_phone'))
              ->maxLength(15)
              ->tel(),
            Textarea::make('notes')
              ->label(__('resources/orders.columns.notes'))
              ->rows(3)
              ->columnSpanFull(),
          ]),

        Section::make()
          ->description(__('resources/orders.sections.payment_description'))
          ->collapsible()
          ->schema([
            Select::make('status')
              ->required()
              ->native(false)
              ->searchable()
              ->preload()
              ->default('pending')
              ->options(OrderStatusEnum::class),
            Select::make('payment_method')
              ->required()
              ->default('qris')
              ->native(false)
              ->searchable()
              ->preload()
              ->options(PaymentMethodEnum::class),
            Select::make('payment_status')
              ->required()
              ->default('pending')
              ->native(false)
              ->searchable()
              ->preload()
              ->options(PaymentStatusEnum::class),
          ]),
      ]);
  }
}
