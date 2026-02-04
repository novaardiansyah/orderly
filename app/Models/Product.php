<?php

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
}
