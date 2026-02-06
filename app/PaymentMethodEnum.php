<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethodEnum: string implements HasLabel
{
  case QRIS     = 'qris';
  case CASH     = 'cash';
  case TRANSFER = 'transfer';

  public function getLabel(): string
  {
    return match ($this) {
      self::QRIS     => __('resources/orders.enums.payment_method.qris'),
      self::CASH     => __('resources/orders.enums.payment_method.cash'),
      self::TRANSFER => __('resources/orders.enums.payment_method.transfer'),
    };
  }
}
