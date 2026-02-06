<?php

/*
 * Project Name: orderly
 * File: OrderObserver.php
 * Created Date: Friday February 6th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
  public function creating(Order $order): void
  {
    $order->code = getCode('order_id');
  }

  public function created(Order $order): void
  {
    $this->_log('Created', $order);
  }

  public function updated(Order $order): void
  {
    $this->_log('Updated', $order);
  }

  public function deleted(Order $order): void
  {
    $this->_log('Deleted', $order);
  }

  public function restored(Order $order): void
  {
    $this->_log('Restored', $order);
  }

  public function forceDeleted(Order $order): void
  {
    $this->_log('Force Deleted', $order);
  }

  private function _log(string $event, Order $order): void
  {
    saveActivityLog([
      'event'        => $event,
      'model'        => 'Order',
      'subject_type' => Order::class,
      'subject_id'   => $order->id,
    ], $order);
  }
}
