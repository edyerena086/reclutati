@component('mail::message')
# ¡Hola {{ $candidateName }}!

Haz recibido un mensaje por parte de **{{ $recruiterName }}** de la empresa **{{ $companyName }}**

El mensaje es el siguiente:

> ___{{ $message }}___

@component('mail::button', ['url' => url('candidate')])
Ver mensaje
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
