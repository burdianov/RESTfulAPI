@component('mail::message')
  # Hello {{ $user->name }}

  You have changed your email. Please the button below to verify your new address:

  @component('mail::button', ['url' => route('verify', ['token' => $user->verification_token])])
    Verify Account
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent

