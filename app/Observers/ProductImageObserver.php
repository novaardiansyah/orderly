<?php

/*
 * Project Name: orderly
 * File: ProductImageObserver.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\ProductImage;
use App\Services\ProductImageResource\ProductImageService;

class ProductImageObserver
{
  public function saving(ProductImage $productImage): void
  {
    $isImageChange = $productImage->isDirty('file_path');
    $oldImage = $productImage->getOriginal('file_path');

    if ($isImageChange) {
      ProductImageService::deleteImage($oldImage);
    }
  }

  public function created(ProductImage $productImage): void
  {
    $this->_log('Created', $productImage);
  }

  public function updated(ProductImage $productImage): void
  {
    $this->_log('Updated', $productImage);
  }

  public function deleted(ProductImage $productImage): void
  {
    $this->_log('Deleted', $productImage);
  }

  public function restored(ProductImage $productImage): void
  {
    $this->_log('Restored', $productImage);
  }

  public function forceDeleted(ProductImage $productImage): void
  {
    ProductImageService::deleteImage($productImage->file_path);
    $this->_log('Force Deleted', $productImage);
  }

  private function _log(string $event, ProductImage $productImage): void
  {
    saveActivityLog([
      'event'        => $event,
      'model'        => 'Product Image',
      'subject_type' => ProductImage::class,
      'subject_id'   => $productImage->id,
    ], $productImage);
  }
}
