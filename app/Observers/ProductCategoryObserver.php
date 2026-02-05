<?php

/*
 * Project Name: orderly
 * File: ProductCategoryObserver.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\ProductCategory;

class ProductCategoryObserver
{
  public function created(ProductCategory $productCategory): void
  {
    $this->_log('Created', $productCategory);
  }

  public function updated(ProductCategory $productCategory): void
  {
    $this->_log('Updated', $productCategory);
  }

  public function deleted(ProductCategory $productCategory): void
  {
    $this->_log('Deleted', $productCategory);
  }

  public function restored(ProductCategory $productCategory): void
  {
    $this->_log('Restored', $productCategory);
  }

  public function forceDeleted(ProductCategory $productCategory): void
  {
    $this->_log('Force Deleted', $productCategory);
  }

  private function _log(string $event, ProductCategory $productCategory): void
  {
    saveActivityLog([
      'event'        => $event,
      'model'        => 'Product Category',
      'subject_type' => ProductCategory::class,
      'subject_id'   => $productCategory->id,
    ], $productCategory);
  }
}
