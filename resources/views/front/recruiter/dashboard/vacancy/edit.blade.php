@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Editar vacante')

{{-- CSS --}}
@section('pageCSS')
	<link rel="stylesheet" href="{{ asset('js/plugin/editor/richtext.min.css') }}">
@stop

{{-- Section Title --}}
@section('sectionTitle', 'Editar vacante')

{{-- Action button --}}
@section('actionButton')
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li>
				<a href="{{ url('recruiter/dashboard/vacancies') }}">
					<i class="icon-material-outline-keyboard-arrow-left"></i> Regresar
				</a>
			</li>
		</ul>
	</nav>
@stop

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				{{-- Headline --}}
				<div class="headline">
					<h3><i class="icon-feather-folder-plus"></i> Vacante</h3>
				</div>

				<div class="content with-padding padding-bottom-10">
					<form action="{{ url('recruiter/dashboard/vacancies/'.$vacancy->id) }}" method="POST">
						@method('PUT')
						<div class="row">
							<div class="col-xl-6">
								<div class="submit-field">
									<h5>*Puesto</h5>
									<input name="puesto" type="text" value="{{ $vacancy->job_title }}" class="with-border">
								</div>
							</div>

							<div class="col-xl-4">
								<div class="submit-field">
									<h5>*Tipo de puesto</h5>
									{{ Form::select('tipoDeVacante', \ReclutaTI\JobType::list(), $vacancy->job_type_id, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
								</div>
							</div>

							<div class="col-xl-2">
								<div class="submit-field">
									<h5>*¿Publicar?</h5>
									{{ Form::select('publicar', [1 => 'No', 2 => 'Si'], ($vacancy->publish) ? 2 : 1, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-4">
								<div class="submit-field">
									<h5>
										*Ubicación de la vacante
										<i class="help-icon" data-tippy-placement="right" data-tippy="" data-original-title="Maximum of 10 tags"></i>
									</h5>
									{{ Form::select('estado', \ReclutaTI\State::list(), $vacancy->state_id, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
								</div>
							</div>

							<div class="col-xl-3">
								<div class="submit-field">
									<h5>Salario min.</h5>
									<input type="text" name="salarioMinimo" value="{{ $vacancy->salary_min }}" class="with-border">
								</div>
							</div>

							<div class="col-xl-3">
								<div class="submit-field">
									<h5>Salario máx.</h5>
									<input type="text" name="salarioMaximo" value="{{ $vacancy->salary_max }}" class="with-border">
								</div>
							</div>

							<div class="col-xl-2">
								<div class="submit-field">
									<h5>¿Mostrar salario?</h5>
									{{ Form::select('segunAptitudes', [1 => 'No', 2 => 'Si'], ($vacancy->salary_show) ? 2 : 1, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<div class="submit-field" id="descripcionBreveSpan">
									<h5>*Descripción breve <span>300 carácteres</span></h5>
									<textarea name="descripcionBreve" onkeyup="countChar(this)" cols="30" rows="2" class="with-border">{{$vacancy->job_small_description}}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<div class="submit-field">
									<h5>*Descripción</h5>
									<textarea name="descripcion" id="description" cols="30" rows="10" class="with-border">{{$vacancy->job_description}}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<div class="notification error closable hidden display-errors">
									<p>
										Se han cometido los siguientes errores:
									</p>

									<ul>
									</ul>
								</div>
							</div>
						</div>

						{{-- button --}}
						<div class="col-xl-12">
							<button class="button ripple-effect big">
								Guardar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>		
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/plugin/editor/jquery.richtext.js') }}"></script>
	<script src="{{ asset('js/front/recruiter/dashboard/vacancy/form.js') }}"></script>
@stop