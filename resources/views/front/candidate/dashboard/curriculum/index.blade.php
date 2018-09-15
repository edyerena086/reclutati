@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Mi Curriculum')

{{-- Section Title --}}
@section('sectionTitle', 'Mi Curriculum')

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-account-circle"></i> Datos Generales</h3>
				</div>

				{{--<div class="content with-padding padding-bottom-0">--}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							<div class="row">
								<div class="col">
									<div class="row">
										<div class="col-xl-6">
											<div class="submit-field">
												<h5>*Primer nombre:</h5>
												<input type="text" class="with-border" value="{{ ucwords(Auth::user()->name) }}">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Segundo nombre:</h5>
												<input type="text" class="with-border" value="{{ Auth::user()->candidate->second_name }}">
											</div>
										</div>
									</div>
									
									{{-- last name --}}
									<div class="row">
										<div class="col-xl-6">
											<div class="submit-field">
												<h5>*Apellido paterno:</h5>
												<input type="text" class="with-border" value="{{ ucwords(Auth::user()->candidate->last_name) }}">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Apellido materno:</h5>
												<input type="text" class="with-border" value="{{ Auth::user()->candidate->second_last_name }}">
											</div>
										</div>
									</div>

									{{-- age and gender --}}
									<div class="row">
										<div class="col-xl-3">
											<div class="submit-field">
												<h5>Edad:</h5>
												<input type="text" class="with-border" value="{{ ucwords(Auth::user()->candidate->last_name) }}">
											</div>
										</div>

										<div class="col-xl-3">
											<div class="submit-field">
												<h5>Genero:</h5>
												{{ Form::select('genero', $genders, Auth::user()->candidate->gender_id, ['class' => 'with-border', 'placeholder' => 'Selecciona']) }}
											</div>
										</div>
									</div>

									{{-- button --}}
									<div class="col-xl-12">
										<button class="button ripple-effect big">
											Guardar
										</button>
									</div>
								</div>
							</div>
						</li>

						<li>
							<div class="row">
								<div class="col">
									<div class="row">
										<div class="col-xl-12">
											<div class="submit-field">
												<h5>*Objetivo laboral:</h5>
												<textarea cols="30" rows="5" class="with-border"></textarea>
											</div>
										</div>
									</div>

									{{-- button --}}
									<div class="col-xl-12">
										<button class="button ripple-effect big">
											Guardar
										</button>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop