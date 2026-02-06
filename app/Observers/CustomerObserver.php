<?php

/*
 * Project Name: orderly
 * File: CustomerObserver.php
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

use App\Models\Customer;

class CustomerObserver
{
  public function creating(Customer $customer): void
  {
    $customer->code = getCode('customer_id');
  }

  public function created(Customer $customer): void
  {
    $this->_log('Created', $customer);
  }

  public function updated(Customer $customer): void
  {
    $this->_log('Updated', $customer);
  }

  public function deleted(Customer $customer): void
  {
    $this->_log('Deleted', $customer);
  }

  public function restored(Customer $customer): void
  {
    $this->_log('Restored', $customer);
  }

  public function forceDeleted(Customer $customer): void
  {
    $this->_log('Force Deleted', $customer);
  }

  private function _log(string $event, Customer $customer): void
  {
    saveActivityLog([
      'event'        => $event,
      'model'        => 'Customer',
      'subject_type' => Customer::class,
      'subject_id'   => $customer->id,
    ], $customer);
  }
}
