<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class SubscribeController extends Controller implements HasMiddleware
{
  public static function middleware()
  {
    return [
      'auth',
    ];
  }
}
