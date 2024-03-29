@component('mail::message')
# Hola {{$user->name}}

Has cambiado el correo eléctronico, por favor verifica la nueva dirección usando el siguiente botón:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Confirmar mi cuenta
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
