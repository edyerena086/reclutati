@component('mail::message')
# ¡Hola {{ $candidateName }}!

Haz recibido un mensaje por parte de {{ $recruiterName }}

El mensaje es el siguiente:

> {{ $message }}

@component('mail::button', ['url' => url('recruiter')])
Ver mensaje
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
