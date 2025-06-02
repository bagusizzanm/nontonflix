<x-mail::message>
  # Membership Expired

  Hi {{ $membership->user->name }},

  Your membership has expired on **{{ $membership->end_date->format('d M Y') }}**.

  <x-mail::button :url="url('/renew')">
    Renew Membership
  </x-mail::button>


  Thanks,<br>
  {{ config('app.name') }}
</x-mail::message>