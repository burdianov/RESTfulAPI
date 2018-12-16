Hello {{ $user->name }}
You have changed your email. Please the link below to verify your new address: {{ route('verify', ['token' => $user->verification_token]) }}
