@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Busqueda de vacantes')

{{-- Content --}}
@section('content')
	<div class="margin-top-90"></div>

	<div class="container">
		<div class="row">
			{{-- sidebar --}}
			<div class="col-xl-3 col-lg-4">
				<form action="{{ url('buscar/vacante') }}" method="GET">
					<!-- Keywords -->
					<div class="sidebar-widget">
						<h3>¿Qué estas buscando?</h3>
						<div class="keywords-container">
							<div class="keyword-input-container">
								<input type="text" name="string" value="{{ request('string') }}" class="keyword-input" placeholder="Ej. Programador Java"/>
							</div>
							{{--<div class="keywords-list"><!-- keywords go here --></div>--}}
							<div class="clearfix"></div>
						</div>
					</div>

					<!-- Location -->
					<div class="sidebar-widget">
						<h3>Ubicación</h3>
						<div class="input-with-icon">
							<div id="autocomplete-container">
								<input id="autocomplete-input" name="state" type="text" value="{{ request('state') }}" placeholder="¿Dónde?">
							</div>
							<i class="icon-material-outline-location-on"></i>
						</div>
					</div>

					<!-- Job Types -->
					{{--<div class="sidebar-widget">
						<h3>Tipo de vacante</h3>

						<div class="switches-list">
							@foreach ($jobTypes as $type)
								<div class="switch-container">
									<label class="switch"><input type="checkbox" name="tipoDeVacante" value='{{ $type->name }}'><span class="switch-button"></span> {{ ucwords($type->name) }}</label>
								</div>
							@endforeach
						</div>
					</div>--}}

					{{-- Send button --}}
					<div class="sidebar-widget">
						<button class="button ripple-effect" style="width: 100%">
							Buscar
						</button>
					</div>
				</form>
			</div>

			{{-- results --}}
			<div class="col-xl-9 col-lg-8 content-left-offset">
				<h3 class="page-title">Resultados de búsqueda</h3>

				<div class="notify-box margin-top-15">
					<div class="switch-container">
						Resultados para: <b>{{ request('string') }}</b>
					</div>

					<div class="sort-by">
						<span>Ordenar por:</span>
						<select class="selectpicker hide-tick">
							<option>Relevancía</option>
							<option>Más reciente</option>
							<option>Más antigüa</option>
						</select>
					</div>
				</div>

				<div class="listings-container compact-list-layout margin-top-35">

					@foreach ($vacancies as $vacancy)
						<!-- Job Listing -->
						<a href="{{ url('vacante/'.$vacancy->vacancy_id) }}" class="job-listing">
							<!-- Job Listing Details -->
							<div class="job-listing-details">

								<!-- Logo -->
								<div class="job-listing-company-logo">
									@if ($vacancy->company_profile_picture != '')
										<img src="{{ asset('storage/recruiter/companies/'.$vacancy->company_id.'/'.$vacancy->company_profile_picture) }}" alt="">
									@else
										<img src="{{ asset('hireo/images/company-logo-01.png') }}" alt="">
									@endif
								</div>

								<!-- Details -->
								<div class="job-listing-description">
									<h3 class="job-listing-title">{{ $vacancy->job_title }}</h3>

									<p>
										{!! $vacancy->job_small_description !!}
									</p>

									<!-- Job Listing Footer -->
									<div class="job-listing-footer">
										<ul>
											<li><i class="icon-material-outline-business"></i> {{ $vacancy->company_name }}</li>
											<li><i class="icon-material-outline-location-on"></i> {{ $vacancy->state }}</li>
											<li><i class="icon-material-outline-business-center"></i> {{ ucwords($vacancy->job_type) }}</li>
											<li><i class="icon-material-outline-access-time"></i> {{ ($vacancy->created_at->diffInDays(\Carbon\Carbon::now()) <= 1) ? '1 dia' : $vacancy->created_at->diffInDays(\Carbon\Carbon::now()).' días' }}</li>
										</ul>
									</div>
								</div>
							</div>
						</a>
					@endforeach
				</div>

				{{-- Paginator --}}
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						{{ $vacancies->links() }}
					</div>
				</div>

				<div style="margin-bottom: 2.5rem;"></div>
			</div>
		</div>
	</div>
@stop