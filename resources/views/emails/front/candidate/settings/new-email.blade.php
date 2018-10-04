@component('mail::message')
# ¡Hola {{ ucwords($user->name) }}!

Se ha cambiado tu cuenta de correo, a continuación tienes información sobre el hecho:

* **Nuevo correo electrónico:** {{ $user->email }}
* **Fecha de cambio** {{ \Carbon\Carbon::now() }}

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
