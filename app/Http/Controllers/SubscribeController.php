<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller implements HasMiddleware
{
  // karena di dalam controller subscribe, maka apapun url yg di inputkan paksa oleh user akan teralihkan oleh middleware auth
  public static function middleware()
  {
    return [
      'auth',
    ];
  }

  public function showPlans()
  {
    $plans = Plan::all();
    return view('subscribe.plans', compact('plans'));
  }

  public function checkoutPlans(Plan $plan)
  {
    $user = Auth::user();
    return view('subscribe.checkout', compact('plan', 'user'));
  }

  public function prosessCheckout(Request $request)
  {
    $user = Auth::user();
    $plan = Plan::findOrFail($request->plan_id);

    $user->memberships()->create([
      'plan_id' => $request->plan_id,
      'active' => true,
      'start_date' => now(),
      'end_date' => now()->addDays($plan->duration),
    ]);
    return redirect()->route('subscribe.success');
  }

  public function showSuccess()
  {
    return view('subscribe.success');
  }
}
