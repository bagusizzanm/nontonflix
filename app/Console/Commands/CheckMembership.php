<?php

namespace App\Console\Commands;

use App\Jobs\CheckMembershipStatus;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class CheckMembership extends Command
{

  protected $signature = 'membership:check';


  protected $description = 'Check and deactive expired membership';


  public function handle()
  {
    Bus::batch([new CheckMembershipStatus()])
      ->then(function (Batch $batch) {
        Log::info('Membership check job has been completed.');
      })
      ->catch(function (Batch $batch, $e) {
        Log::error('Membership check job has failed: ' . $e->getMessage());
      })
      ->finally(function (Batch $batch) {
        Log::info('Membership check job has finished.');
      })
      ->dispatch();
  }
}
