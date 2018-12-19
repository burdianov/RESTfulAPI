@component('mail::message')
  # Hello {{ $user->name }}

  Thank you for creating an account. Please verify your email using this button:

  @component('mail::button', ['url' => route('verify', ['token' => $user->verification_token])])
    Verify Account
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent


