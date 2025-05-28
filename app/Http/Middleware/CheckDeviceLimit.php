<?php

namespace App\Http\Middleware;

use App\Models\UserDevice;
use Closure;
use App\Models\UserDevices;
use Illuminate\Http\Request;
use App\Services\DeviceLimiteService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDeviceLimit
{
  protected $deviceService;

  public function __construct(DeviceLimiteService $deviceService)
  {
    $this->deviceService = $deviceService;
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */

  public function handle(Request $request, Closure $next): Response
  {
    $user = Auth::user();

    if (!$user) {
      return $next($request);
    }

    if ($request->routeIs('login') || $request->routeIs('logout')) {
      return $next($request);
    }

    $sessionDeviceId = session('device_id');

    $device = UserDevice::where('user_id', $user->id)
      ->where('device_id', $sessionDeviceId)
      ->first();

    if (!$device) {
      $device = $this->deviceService->registerDevices($user);
      if (!$device) {
        Auth::logout();
        return redirect()->route('login')->withErrors(['device' => 'Anda telah mencapai batas maksimum perangkat. Silahkan logout dari perangkat lain.']);
      }
    }
    return $next($request);
  }
}
