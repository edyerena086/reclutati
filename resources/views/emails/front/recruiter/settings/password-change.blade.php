@component('mail::message')
# ¡Hola {{ ucwords($userName) }}!

Se ha cambiado la contraseña de tu cuenta de ReclutaTI, a continuación tienes información sobre el hecho:

* **Nueva contraseña:** {{ $password }}
* **Fecha de cambio** {{ \Carbon\Carbon::now() }}

@component('mail::button', ['url' => url('recruiter')])
Ir a mi cuenta
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
