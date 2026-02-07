<?php

/*
 * Project Name: orderly
 * File: OrderForm.php
 * Created Date: Friday February 6th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Customer;
use App\PaymentMethodEnum;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
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
          ->columnSpan(2)
          ->schema([
            Grid::make(2)
              ->schema([
                Hidden::make('customer_id')
                  ->nullable(),
                TextInput::make('phone')
                  ->label(__('resources/orders.labels.customer_phone'))
                  ->maxLength(15)
                  ->telRegex('/^[0-9]+$/')
                  ->live(onBlur: true)
                  ->afterStateUpdated(fn (?string $state, Set $set) => self::handlePhoneChange($state, $set)),
                TextInput::make('name')
                  ->label(__('resources/orders.labels.customer_name'))
                  ->maxLength(255)
                  ->required(),
              ]),

            Select::make('payment_method')
              ->required()
              ->default('qris')
              ->native(false)
              ->searchable()
              ->preload()
              ->options(PaymentMethodEnum::class),
            Textarea::make('notes')
              ->label(__('resources/orders.columns.notes'))
              ->rows(3)
              ->columnSpanFull(),
          ]),
      ])
      ->columns(3);
  }

  protected static function handlePhoneChange(?string $state, Set $set): void
  {
    $customer = Customer::where('phone', $state)->first();

    if ($customer) {
      $set('name', $customer->name);
      $set('customer_id', $customer->id);
      return;
    }

    $set('name', null);
    $set('customer_id', null);
  }
}
