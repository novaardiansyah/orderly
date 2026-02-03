<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
  use HasFactory, Notifiable;

  protected $fillable = ['name', 'email', 'password'];

  protected $hidden = ['password', 'remember_token'];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function canAccessPanel(Panel $panel): bool
  {
    return str_ends_with($this->email, '@novaardiansyah.id');
  }
}
