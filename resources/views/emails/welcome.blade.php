@component('mail::message')
# Hola {{$user->name}}

Gracias por crear tu cuenta, por favor verificala utilizando el siguiente botón:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Confirmar mi cuenta
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
