<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $fillable = [
    'transaction_number',
    'total_amount',
    'payment_status',
    'midtrans_snap_token',
    'midtrans_booking_code',
    'midtrans_transaction_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function plan()
  {
    return $this->belongsTo(Plan::class);
  }
}
