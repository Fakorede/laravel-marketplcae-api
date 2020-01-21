Hello {{ $user->name }},

You recently requested for a change of email address. If this was you, please verify your new email using the link below:

{{ route('verify', $user->verification_token) }}