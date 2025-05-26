<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
  protected $fillable = [
    'user_id',
    'device_id',
    'device_name',
    'device_type',
    'platform',
    'platform_version',
    'browser',
    'browser_version',
    'last_active',
  ];

  protected $casts = [
    'last_active' => 'datetime',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
