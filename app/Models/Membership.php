<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
  protected $fillable = [
    'user_id',
    'plan_id',
    'active',
    'start_date',
    'end_date',
  ];

  public function plan()
  {
    return $this->belongsTo(Plan::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
