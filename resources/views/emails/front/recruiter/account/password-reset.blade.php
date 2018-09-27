@component('mail::message')
# ¡Hola {{ ucwords($userName) }}!

Se ha solicitado reestablecer tu contarseña, para ello por favor da clic en el botón el cual te llevará al formulario donde podrás cambair tu contarseña.

**NOTA:** este botón sólo tiene una validez de 10 minutos

@component('mail::button', ['url' => $url])
Reestablecer contraseña
@endcomponent

¡Gracias y nos vemos pronto!<br>
Equipo de <a href="{{ url('/') }}">{{ config('app.name') }}</a>
@endcomponent
