@extends('layouts.back.account')

{{-- Page Title --}}
@section('pageTitle', 'Inicio de sesión')

{{-- Content --}}
@section('content')
	<form action="{{ url('back') }}" method="post">
		@csrf
		
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
				<h5 class="content-group">Inicio de sesión<small class="display-block">Portal administrativo</small></h5>
			</div>

			@if($errors->count() > 0)
				<div class="alert alert-danger alert-styled-left alert-bordered">
					Combinación de usuario y contraseña incorrecta.
				</div>
			@endif

			<div class="form-group has-feedback has-feedback-left">
				<input type="email" name="correoElectronico" class="form-control" placeholder="Correo electronico">
				<div class="form-control-feedback">
					<i class="icon-user text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input type="password" name="password" class="form-control" placeholder="Contraseña">
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Inciar sesión <i class="icon-circle-right2 position-right"></i></button>
			</div>

			<div class="form-group">
				<a href="{{ url('admin/account/password-reset') }}">¿Olvidaste tu contraseña?</a>
			</div>
		</div>
	</form>
@stop