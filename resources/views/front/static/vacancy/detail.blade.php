@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Vacante: '.$vacancy['job_title'])

{{-- Facebook data structure --}}
@section('facebook')
	<meta property="og:title" content='Vacante: '{{ $vacancy['job_title'] }} />
	<meta property="og:url" content="{{ url('vacante/'.$vacancy['id']) }}" />
	<meta property="og:image" content="https://reclutati.com/images/icono.png" />
	<meta property="og:description" content="{{ $vacancy['job_small_description'] }}"/>
@stop

{{-- Page CSS --}}
@section('pageCSS')
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('js/plugin/shareButton/jssocials.css') }}" />
	<link rel="stylesheet" href="{{ asset('js/plugin/shareButton/jssocials-theme-flat.css') }}" />
@stop

{{-- Content --}}
@section('content')
	<div class="single-page-header" data-background-image="{{ asset('hireo/images/single-job.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-page-header-inner">
						<div class="left-side">
							<div class="header-image">
								<a href="{{ url('perfil/empresa/'. $vacancy['company_id']) }}">
									@if ($vacancy['company_profile'] == '')
										<img src="{{ asset('hireo/images/company-logo-05.png') }}" alt="">
									@else
										<img src="{{ asset('storage/recruiter/companies/'. $vacancy['company_id'].'/'.$vacancy['company_profile']) }}" alt="">
									@endif
								</a>
							</div>
							<div class="header-details">
								<h3>{{ $vacancy['job_title'] }}</h3>
								<h5>{{ $vacancy['company_name'] }}</h5>
								<ul>
									<li><div class="verified-badge-with-title">Verificado</div></li>
								</ul>
							</div>
						</div>
						<div class="right-side">
							<div class="salary-box">
								<div class="salary-type">Salario</div>
								<div class="salary-amount">
									@if ($vacancy['salary_min'] != '' && $vacancy['salary_max'] != '')
										${{ $vacancy['salary_min'] }} - ${{ $vacancy['salary_max'] }}
									@else
										No se muestra
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Job description --}}
	<div class="container">
		<div class="row">
			{{-- Content --}}
			<div class="col-xl-8 col-lg-8 content-right-offset">
				<div class="single-page-section">
					<h3 class="margin-bottom-25">Descripción de Vacante</h3>
					{!! $vacancy['job_description'] !!}
				</div>
			</div>

			{{-- sidebar --}}
			<div class="col-xl-4 col-lg-4">
				<div class="sidebar-container">
					@if (!Auth::check())
						<a href="{{ url('candidate/login/vacancy/'.$vacancy['id']) }}" class="apply-now-button">Aplica ahora <i class="icon-material-outline-arrow-right-alt"></i></a>
					@elseif (Auth::user()->role_id == \ReclutaTI\Role::CANDIDATE && Auth::user()->candidate->vacancies->where('vacancy_id', $vacancy['id'])->where('status', '!=', 2)->first() == null)
						<a href="{{ url('vacante/aplicar/'.$vacancy['id']) }}" class="apply-now-button lets-apply">Aplica ahora <i class="icon-material-outline-arrow-right-alt"></i></a>

					@elseif (Auth::user()->role_id == \ReclutaTI\Role::CANDIDATE && Auth::user()->candidate->vacancies->where('vacancy_id', $vacancy['id'])->first())

						<a href="" class="apply-now-button btn-has-applied">Ya haz aplicado <i class="icon-material-outline-check-circle"></i></a>
					@endif

					<div class="sidebar-widget">
						<div class="job-overview">
							<div class="job-overview-headline">Carácteristicas</div>
							<div class="job-overview-inner">
								<ul>
									<li>
										<i class="icon-material-outline-location-on"></i>
										<span>Ubicación</span>
										<h5>{{ $vacancy['job_location'] }}</h5>
									</li>

									<li>
										<i class="icon-material-outline-business-center"></i>
										<span>Tipo de Vacante</span>
										<h5>{{ ucwords($vacancy['job_type']) }}</h5>
									</li>

									<li>
										<i class="icon-material-outline-school"></i>
										<span>Formación mínima</span>
										<h5>{{ ucwords($vacancy['educative_level']) }}</h5>
									</li>

									@if ($vacancy['salary_min'] != '' && $vacancy['salary_max'] != '')

										<li>
											<i class="icon-line-awesome-money"></i>
											<span>Salario</span>
											<h5>${{ $vacancy['salary_min'] }} - ${{ $vacancy['salary_max'] }}</h5>
										</li>

									@endif
								</ul>
							</div>
						</div>
					</div>

					{{-- bookmark --}}
					@if(Auth::check() && Auth::user()->role_id == \ReclutaTI\Role::CANDIDATE && Auth::user()->candidate->vacancies->where('vacancy_id', $vacancy['id'])->first() == null)
						<div class="sidebar-widget bookmark-wrapper-rti">
							<h3>
								Guardar vacante a favoritos
							</h3>

							<button class="bookmark-button margin-bottom-25" data-url="{{ url('vacante/guardar/'.$vacancy['id']) }}">
								<span class="bookmark-icon"></span>
								<span class="bookmark-text">Guardar vacante</span>
								<span class="bookmarked-text">Vacante guardada</span>
							</button>
						</div>
					@endif

					<div class="sidebar-widget">
						<h3>
							Comparte la vacante
						</h3>

						{{-- social networks --}}
						<div id="share" data-url="{{ url('vacante/'.$vacancy['id']) }}" data-text="Vacante: {{ $vacancy['job_title'] }} en {{ $vacancy['job_location'] }}" class="text-center"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

{{-- Page JS --}}
@section('pageJS')
	<script src="{{ asset('js/plugin/shareButton/jssocials.min.js') }}"></script>
	<script src="{{ asset('js/front/vacancy.js') }}"></script>
@stop