<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum PaymentStatusEnum: string implements HasLabel
{
  case PENDING    = 'pending';
  case PAID       = 'paid';
  case CANCELLED  = 'cancelled';

  public function getLabel(): string
  {
    return match ($this) {
      self::PENDING    => 'Pending',
      self::PAID       => 'Paid',
      self::CANCELLED  => 'Cancelled',
    };
  }
}
