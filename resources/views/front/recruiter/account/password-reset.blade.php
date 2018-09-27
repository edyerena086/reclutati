@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Reestablece tu contraseña')

{{-- Content --}}
@section('content')
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3">
					<h2>Reestablece tu contraseña</h2>
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
						Ingresa tu nueva contraseña
					</h3>

					<form action="{{ url('recruiter/account/password/reset/'.$id) }}" method="post">
						@csrf

						<div class="input-with-icon-left">
							<input class="with-border" name="password" type="password" placeholder="Nueva contarseña" />
							<i id="i-password" class="icon-line-awesome-pencil"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="password_confirmation" type="password" placeholder="Confirmar nueva contarseña" />
							<i id="i-password_confirmation" class="icon-line-awesome-pencil"></i>
						</div>

						<div class="notification error closable hidden">
							<p>
								Se han cometido los siguientes errores:
							</p>

							<ul>
							</ul>
						</div>

						<button class="submit button margin-top-15" id="submit">Enviar</button>
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