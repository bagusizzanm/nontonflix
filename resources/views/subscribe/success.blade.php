@extends('layouts.subscribe')

@section('title', 'Payment Success')
@section('page-title', 'Payment Success')

@section('content')
<div class="mt-5 text-center">
  <img src="{{ asset('assets/img/logo-text.png') }}" alt="NontonFlix" class="mb-4" width="400">
  <h2 class="mb-2 text-white">Yay! Selamat Pembayaran Kamu</h2>
  <h3 class="mb-4 text-white">Telah kami Terima</h3>
  <div class="mb-4 text-success">
    <i class="fas fa-check-circle fa-5x"></i>
  </div>
  <h4 class="mb-4 text-white">Selamat Menikmati</h4>
  <a href="/" class="px-5 btn btn-green btn-lg">
    Mulai Nonton
  </a>
</div>
@endsection

@section('scripts')
@endsection