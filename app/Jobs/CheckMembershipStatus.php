<?php

namespace App\Jobs;

use App\Models\Membership;
use Illuminate\Bus\Batchable;
use App\Events\MembershipHasExpired;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckMembershipStatus implements ShouldQueue
{
  use Queueable, Batchable, Dispatchable, InteractsWithQueue, SerializesModels;

  public $timeout = 120;
  public $tries = 5;

  public function __construct()
  {
    //
  }

  public function handle(): void
  {
    Membership::where('active', true)
      ->where('end_date', '<', now()->toDateString())
      ->chunk(100, function ($memberships) {
        foreach ($memberships as $membership) {
          $membership->update(['active' => false]);
          event(new MembershipHasExpired($membership));
        }
      });
  }
}
