<?php

/*
 * Project Name: orderly
 * File: ProductImageService.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Services\ProductImageResource;

use Illuminate\Support\Facades\Storage;

class ProductImageService
{
  public static function deleteImage(?string $imagePath): void
  {
    if ($imagePath) {
      Storage::disk('public')->delete($imagePath);
    }
  }
}
