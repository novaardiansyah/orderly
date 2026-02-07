<?php

namespace App\Models;

use App\Observers\CustomerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(CustomerObserver::class)]
class Customer extends Model
{
  use SoftDeletes;

  protected $table = 'customers';

  protected $fillable = ['code', 'name', 'phone', 'notes', 'is_member'];

  protected $casts = [
    'is_member' => 'boolean',
  ];

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class);
  }
}
