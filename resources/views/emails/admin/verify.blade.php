@component('mail::message')
# Hello {{ $user->name }},

Thank you for registering as an admin.

Please verify your email address by clicking the button below. You **must** verify your email before you can log in.

@component('mail::button', ['url' => $verificationUrl])
Verify Email
@endcomponent

If you did not create this account, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
