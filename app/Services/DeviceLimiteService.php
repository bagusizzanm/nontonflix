<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDevice;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Str;

class DeviceLimiteService
{
  /**
   * Create a new class instance.
   */
  public function registerDevices(User $user)
  {
    $deviceInfo = $this->getDeviceInfo();

    $existingDevice = $this->findExistingDevice($user, $deviceInfo);

    if ($existingDevice) {
      $existingDevice->update(['last_active' => now()]);
      session(['device_id' => $existingDevice->id]);
      return $existingDevice;
    }

    if ($this->hasReachedDeviceLimit($user)) {
      return false;
    }

    $device = $this->createNewDevice($user, $deviceInfo);
    session(['device_id' => $device->id]);
    return $device;
  }

  private function hasReachedDeviceLimit(User $user)
  {
    $maxDevices = $user->getCurrentPlan()->max_devices ?? 1;
    return UserDevice::where('user_id', $user->id)->count() >= $maxDevices;
  }

  private function findExistingDevice(User $user, array $deviceInfo)
  {
    return UserDevice::where('user_id', $user->id)
      ->where('device_type', $deviceInfo['device_type'])
      ->where('platform', $deviceInfo['platform'])
      ->where('browser', $deviceInfo['browser'])
      ->first();
  }

  private function createNewDevice(User $user, array $deviceInfo)
  {
    return UserDevice::create([
      'user_id' => $user->id,
      'device_id' => $this->generateDeviceId(),
      'device_name' => $deviceInfo['device_name'],
      'device_type' => $deviceInfo['device_type'],
      'platform' => $deviceInfo['platform'],
      'platform_version' => $deviceInfo['platform_version'],
      'browser' => $deviceInfo['browser'],
      'browser_version' => $deviceInfo['browser_version'],
      'last_active' => now()
    ]);
  }

  private function generateDeviceId()
  {
    return Str::random(32);
  }

  private function getDeviceInfo()
  {
    return [
      'device_name' => $this->generateDeviceName(),
      'device_type' => Agent::isDesktop() ? 'desktop' : (Agent::isPhone() ? 'phone' : 'tablet'),
      'platform' => Agent::platform(),
      'platform_version' => Agent::version(Agent::platform()),
      'browser' => Agent::browser(),
      'browser_version' => Agent::version(Agent::browser())
    ];
  }

  private function generateDeviceName()
  {
    return ucfirst(Agent::platform()) . ' ' . ucfirst(Agent::browser());
  }

  public function logoutDevice($deviceId)
  {
    // dd("Logout device called with ID: " . $deviceId);
    UserDevice::where('id', $deviceId)->delete();
    session()->forget('device_id');
  }
}
