@component('mail::message')
# ¡Hola {{ ucwords($candidateName) }}!

¡Felicidades!, has aplicado para la vacante {{ $vacancyTitle }}

Ahora ha esperar que la empresa se contacte contigo, mucha suerte y ¡adelante!

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
