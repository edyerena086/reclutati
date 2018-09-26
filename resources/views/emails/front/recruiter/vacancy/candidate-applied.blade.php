@component('mail::message')
# ¡Hola {{ $recruiterName }}!

¡Felicidades! un candidato ha aplicado a tu vacante, a continuación te dejamos la información:

* **Título de la vacante**: {{ $vacancy }}
* **Nombre de candidato**: {{ $candidate }}
* **Fecha de aplicación** {{ \Carbon\Carbon::now() }}

Da clic en el botón y revisa el resto de la información del candidato.

@component('mail::button', ['url' => url('recruiter')])
Panel de control
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
