<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
  public function creating(Product $product): void
  {
    $product->code = getCode('product_id');
  }

  /**
   * Handle the Product "created" event.
   */
  public function created(Product $product): void
  {
    $this->_log('Created', $product);
  }

  /**
   * Handle the Product "updated" event.
   */
  public function updated(Product $product): void
  {
    $this->_log('Updated', $product);
  }

  /**
   * Handle the Product "deleted" event.
   */
  public function deleted(Product $product): void
  {
    $this->_log('Deleted', $product);
  }

  /**
   * Handle the Product "restored" event.
   */
  public function restored(Product $product): void
  {
    $this->_log('Restored', $product);
  }

  /**
   * Handle the Product "force deleted" event.
   */
  public function forceDeleted(Product $product): void
  {
    $this->_log('Force Deleted', $product);
  }

  private function _log(string $event, Product $product): void
  {
    saveActivityLog([
      'event'        => $event,
      'model'        => 'Product',
      'subject_type' => Product::class,
      'subject_id'   => $product->id,
    ], $product);
  }
}
