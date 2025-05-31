@component('mail::message')

# Membership Expired

Hi {{ $membership->user->name }},

Your membership has expired on **{{ $membership->end_date->format('d M Y') }}**.

@component('mail::button', ['url' => url('/renew')])
Renew Membership
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
