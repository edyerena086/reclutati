@component('mail::message')
# ¡Bienvenido a ReclutaTI!

¡Hola {{ ucwords($userName) }}! muchas gracias por crear tu cuenta, ahora podrás publicar vacantes, así como buscar los mejores perfiles en TI, no esperes más, publica tu primera vacante, el botón de abajo te llevará al lugar indicado.

@component('mail::button', ['url' => url('recruiter')])
Panel de control
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
