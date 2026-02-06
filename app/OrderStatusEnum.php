<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum OrderStatusEnum: string implements HasLabel
{
  case PENDING    = 'pending';
  case COOKING    = 'cooking';
  case DELIVERING = 'delivering';
  case COMPLETED  = 'completed';

  public function getLabel(): string
  {
    return match ($this) {
      self::PENDING    => __('resources/orders.enums.order_status.pending'),
      self::COOKING    => __('resources/orders.enums.order_status.cooking'),
      self::DELIVERING => __('resources/orders.enums.order_status.delivering'),
      self::COMPLETED  => __('resources/orders.enums.order_status.completed'),
    };
  }
}
