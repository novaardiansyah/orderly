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
      self::QRIS     => 'QRIS',
      self::CASH     => 'Cash',
      self::TRANSFER => 'Transfer',
    };
  }
}
