@component('mail::message')
# Hello {{ $user->name }},

You recently requested for a change of email address. If this was you, please verify your new email using the link below:

@component('mail::button', ['url' => route('verify', $user->verification_token) ])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
