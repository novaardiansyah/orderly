<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum OrderStatusEnum: string implements HasLabel
{
  case PENDING    = 'pending';
  case PROCESSING = 'processing';
  case COMPLETED  = 'completed';
  case CANCELLED  = 'cancelled';

  public function getLabel(): string
  {
    return match ($this) {
      self::PENDING    => 'Pending',
      self::PROCESSING => 'Processing',
      self::COMPLETED  => 'Completed',
      self::CANCELLED  => 'Cancelled',
    };
  }
}
