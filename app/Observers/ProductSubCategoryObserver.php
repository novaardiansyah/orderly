<?php

/*
 * Project Name: orderly
 * File: ProductSubCategoryObserver.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\ProductSubCategory;

class ProductSubCategoryObserver
{
  public function created(ProductSubCategory $productSubCategory): void
  {
    $this->_log('Created', $productSubCategory);
  }

  public function updated(ProductSubCategory $productSubCategory): void
  {
    $this->_log('Updated', $productSubCategory);
  }

  public function deleted(ProductSubCategory $productSubCategory): void
  {
    $this->_log('Deleted', $productSubCategory);
  }

  public function restored(ProductSubCategory $productSubCategory): void
  {
    $this->_log('Restored', $productSubCategory);
  }

  public function forceDeleted(ProductSubCategory $productSubCategory): void
  {
    $this->_log('Force Deleted', $productSubCategory);
  }

  private function _log(string $event, ProductSubCategory $productSubCategory): void
  {
    saveActivityLog([
      'event'        => $event,
      'model'        => 'Product Sub Category',
      'subject_type' => ProductSubCategory::class,
      'subject_id'   => $productSubCategory->id,
    ], $productSubCategory);
  }
}
