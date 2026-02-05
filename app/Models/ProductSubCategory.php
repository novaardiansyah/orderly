<?php

/*
 * Project Name: orderly
 * File: ProductSubCategory.php
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

use App\Observers\ProductSubCategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductSubCategoryObserver::class)]
class ProductSubCategory extends Model
{
  use SoftDeletes;

  protected $table = 'product_sub_categories';

  protected $fillable = ['category_id', 'name', 'description'];

  public function category()
  {
    return $this->belongsTo(ProductCategory::class);
  }
}
