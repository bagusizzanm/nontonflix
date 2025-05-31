@props(['url'])
<tr>
  <td class="header">
    <a href="{{ $url }}" style="display: inline-block;">
      @if (trim($slot) === 'nontonflix.com')
      <img src="{{ asset('assets/img/logo-icon2.png') }}" class="logo" alt="NontonFlix Logo">
      @else
      {{ $slot }}
      @endif
    </a>
  </td>
</tr>
