@component('mail::message')
# ¡Bienvenido a ReclutaTI!

¡Hola {{ ucwords($user->name) }}! muchas gracias por crear tu cuenta, ahora podrás publicar tu CV y que miles de reclutadores puedan contactarte y ver todas tus asombrosas capacidades.

¿Qué esperas?, empieza creando tu curriculum, el botón te llevará al lugar indicado.

@component('mail::button', ['url' => url('candidate')])
Panel de control
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
