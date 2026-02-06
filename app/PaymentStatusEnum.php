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
      self::PENDING    => __('resources/orders.enums.payment_status.pending'),
      self::PAID       => __('resources/orders.enums.payment_status.paid'),
      self::CANCELLED  => __('resources/orders.enums.payment_status.cancelled'),
    };
  }
}
