<?php

/*
 * Project Name: orderly
 * File: ProductImage.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Models;

use App\Observers\ProductImageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(ProductImageObserver::class)]
class ProductImage extends Model
{
  use SoftDeletes;

  protected $table = 'product_images';

  protected $fillable = ['product_id', 'file_path', 'description', 'is_active'];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }
}
