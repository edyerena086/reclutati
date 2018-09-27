@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Recupera tu contraseña')

{{-- Content --}}
@section('content')
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3">
					<h2>Recupera tu contraseña</h2>
				</div>
			</div>
		</div>
	</div>

	{{-- forms contents --}}
	<div class="container">
		<div class="row">
			<diiv class="col-xl-6 offset-xl-3">
				<section id="contact" class="margin-bottom-60">
					<h3 class="headline margin-top-15 margin-bottom-35">
						Ingresa tu cuenta de correo electrónico
					</h3>

					<form action="{{ url('recruiter/account/password/recover') }}" method="post">
						@csrf

						<div class="input-with-icon-left">
							<input class="with-border" name="correoElectronico" type="email" placeholder="Correo electrónico" />
							<i id="i-correoElectronico" class="icon-material-outline-email"></i>
						</div>

						<div class="notification error closable hidden">
							<p>
								Se han cometido los siguientes errores:
							</p>

							<ul>
							</ul>
						</div>

						<button class="submit button margin-top-15" id="submit">Enviar</button>

						<ul class="ul-link">
							<li>
								<a href="{{ url('recruiter') }}">Iniciar sesión</a>
							</li>
						</ul>
					</form>
				</section>
			</diiv>
		</div>
	</div>
@stop

{{-- Page JS --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/account/password.js') }}"></script>
@stop