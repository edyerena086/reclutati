@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Crea tu cuenta')

{{-- Content --}}
@section('content')
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3">
					<h2>Crea tu cuenta en ReclutaTI</h2>
				</div>
			</div>
		</div>
	</div>

	{{-- forms contents --}}
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-3">
				<section id="contact" class="margin-bottom-60">
					<h3 class="headline margin-top-15 margin-bottom-35">
						Registrate usando tu correo
						<span>
							<mark class="color">Todos los campos son obligatorios</mark>
						</span>
					</h3>

					<form id="frmStore" action="{{ url('recruiter/account') }}">
						@csrf
						<div class="input-with-icon-left">
							<input class="with-border" name="nombre" type="text" placeholder="Nombre" />
							<i id="i-nombre" class="icon-material-outline-account-circle"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="apellidoPaterno" type="text" placeholder="Apellido paterno"/>
							<i id="i-apellidoPaterno" class="icon-material-outline-account-circle"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="correoElectronico" type="email" placeholder="Correo electrónico" />
							<i id="i-correoElectronico" class="icon-material-outline-email"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="password" type="password" placeholder="Contraseña" />
							<i id="i-password" class="icon-line-awesome-pencil"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="password_confirmation" type="password" placeholder="Confirmación de contarseña" />
							<i class="icon-line-awesome-pencil"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="telefono" type="text" placeholder="Télefono" />
							<i id="i-telefono" class="icon-feather-phone"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="empresa" type="text" placeholder="Empresa" />
							<i id="i-empresa" class="icon-material-outline-business"></i>
						</div>

						<div class="notification error closable hidden">
							<p>
								Se han cometido los siguientes errores:
							</p>

							<ul>
							</ul>
						</div>

						<p>
							Al dar clic en el botón "Crear cuenta" estas aceptando los <a href="{{ url('terminos-y-condiciones') }}" target="_blank">Términos y Condiciones de uso.</a>
						</p>

						<button class="submit button margin-top-15" id="submit">Crear cuenta</button>
					</form>
				</section>
			</div>
		</div>
	</div>
@stop

{{-- Page JS --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/account/store.js') }}"></script>
@stop