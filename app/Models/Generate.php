<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Generate extends Model
{
  use SoftDeletes;

  protected $table = 'generates';
  protected $fillable = ['name', 'alias', 'prefix', 'suffix', 'separator', 'queue'];
  protected $casts = [
    'queue' => 'integer',
  ];
}
