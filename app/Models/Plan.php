<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  protected $fillable = ['title', 'price', 'duration', 'resolution', 'max_devices'];

  public function memberships()
  {
    return $this->hasMany(Membership::class);
  }

  public function users()
  {
    // tabel membership sebagai pivot yang menjembatani plan_id dan user_id
    return $this->belongsToMany(User::class, 'memberships', 'plan_id', 'user_id');
  }
}
