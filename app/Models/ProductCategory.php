<?php
/*
 * Project Name: orderly
 * File: ProductCategory.php
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

use App\Observers\ProductCategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductCategoryObserver::class)]
class ProductCategory extends Model
{
  use SoftDeletes;

  protected $table = 'product_categories';

  protected $fillable = ['name', 'description'];

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
