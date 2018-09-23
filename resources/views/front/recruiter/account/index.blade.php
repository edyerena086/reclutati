@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Inicia tu sesión')

{{-- Content --}}
@section('content')
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-xl-3">
					<h2>Inicia tu sesión</h2>
				</div>
			</div>
		</div>
	</div>

	{{-- forms contents --}}
	<div class="container">
		@if (session('error'))
			<div class="row">
				<div class="col-xl-6 offset-xl-3">
					<div class="notification error closable">
						<p>
							{{ session('error') }}
						</p>
					</div>
				</div>
			</div>
		@endif

		<div class="row">
			<div class="col-xl-6 offset-xl-3">
				<section id="contact" class="margin-bottom-60">
					<h3 class="headline margin-top-15 margin-bottom-35">
						Inicia tu sesión por correo electrónico
					</h3>

					<form action="{{ url('recruiter') }}" method="post">
						@csrf
						
						@if ($errors->count() > 0) 
							<div class="notification error closable">
								<p>
									La combinación de correo electrónico y contraseña es incorrecta.
								</p>
							</div>
						@endif

						<div class="input-with-icon-left">
							<input class="with-border" name="correoElectronico" type="email" value="{{ old('correoElectronico') }}" placeholder="Correo electrónico" />
							<i id="i-correoElectronico" class="icon-material-outline-email"></i>
						</div>

						<div class="input-with-icon-left">
							<input class="with-border" name="password" type="password" placeholder="Contraseña" />
							<i id="i-password" class="icon-line-awesome-pencil"></i>
						</div>

						<div>
							<div class="checkbox">
								<input type="checkbox" value="on" name="trabajoActual" id="remember">
								<label for="remember"><span class="checkbox-icon"></span> Recuerdame</label>
							</div>
						</div>

						<button class="submit button margin-top-15" id="submit">Iniciar sesión</button>

						<ul class="ul-link">
							<li>
								<a href="{{ url('recruiter/account/password/recover') }}">¿Olvidaste tu contraseña?</a>
							</li>

							<li>
								<a href="{{ url('recruiter/account') }}">¿No tienes cuenta?, crea la ¡aqui!</a>
							</li>
						</ul>
					</form>
				</section>
			</div>
		</div>
	</div>
@stop