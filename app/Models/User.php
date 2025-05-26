<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function memberships()
  {
    return $this->hasMany(Membership::class);
  }

  public function devices()
  {
    return $this->hasMany(UserDevice::class);
  }

  public function hasMembershipPlan(): bool
  {
    return $this->memberships()
      ->where('active', true)
      ->where('end_date', '>', now())
      ->exists();
  }

  public function getCurrentPlan()
  {
    $activeMembership = $this->memberships()
      ->where('active', true)
      ->where('start_date', '<=', now())
      ->where('end_date', '>=', now())
      ->latest()
      ->first();

    if (!$activeMembership) {
      return null;
    }

    return Plan::find($activeMembership->plan_id);
  }
}
