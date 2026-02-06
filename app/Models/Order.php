<?php

namespace App\Models;

use App\Observers\OrderObserver;
use App\OrderStatusEnum;
use App\PaymentMethodEnum;
use App\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(OrderObserver::class)]
class Order extends Model
{
  use SoftDeletes;

  protected $table = 'orders';

  protected $fillable = ['code', 'quantity', 'total_price', 'status', 'payment_method', 'payment_status', 'notes'];

  protected $casts = [
    'status'         => OrderStatusEnum::class,
    'payment_method' => PaymentMethodEnum::class,
    'payment_status' => PaymentStatusEnum::class,
  ];
}
