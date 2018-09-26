@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Vacante: '.$vacancy['job_title'])

{{-- Content --}}
@section('content')
	<div class="single-page-header" data-background-image="{{ asset('hireo/images/single-job.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-page-header-inner">
						<div class="left-side">
							<div class="header-image">
								<a href="{{ url('empresa/'. $vacancy['company_id']) }}">
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
									{{--<li><a href="single-company-profile.html"><i class="icon-material-outline-business"></i> King</a></li>
									<li><div class="star-rating" data-rating="4.9"></div></li>
									<li><img class="flag" src="{{ asset('hireo/images/flags/gb.svg') }}" alt=""> United Kingdom</li>--}}
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
					@elseif (Auth::user()->role_id == \ReclutaTI\Role::CANDIDATE && Auth::user()->candidate->vacancies->where('vacancy_id', $vacancy['id'])->first() == null)
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
				</div>
			</div>
		</div>
	</div>
@stop

{{-- Page JS --}}
@section('pageJS')
	<script src="{{ asset('js/front/vacancy.js') }}"></script>
@stop