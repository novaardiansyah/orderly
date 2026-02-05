<?php

/*
 * Project Name: orderly
 * File: Product.php
 * Created Date: Wednesday February 4th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
  use SoftDeletes;

  protected $table = 'products';

  protected $fillable = ['code', 'name', 'sell_price', 'cost_price', 'stock'];

  protected $casts = [
    'sell_price' => 'decimal:2',
    'cost_price' => 'decimal:2',
    'stock' => 'integer',
  ];

  public function category()
  {
    return $this->belongsTo(ProductCategory::class);
  }
}
