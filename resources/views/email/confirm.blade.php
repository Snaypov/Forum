@component('mail::message')
# Confirm your email address

Dear user. If you want to finish registration, please click button down below.

@component('mail::button', ['url' => "http://localhost:8000/confim-auth/$email"])
Confirm Email.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
