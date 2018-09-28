@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Bolsa de trabajo para profesionales de TI')

{{-- Content --}}
@section('content')
	{{-- Slider y buscador --}}
	<div class="intro-banner" data-background-image="{{ asset('hireo/images/home-background.jpg') }}">
		<div class="container">
			<!-- Intro Headline -->
			<div class="row">
				<div class="col-md-12">
					<div class="banner-headline">
						<h3>
							<strong>ReclutaTI la bolsa de trabajo para los profesionales en TI.</strong>
							<br>
							<span>Todos los días encontrarás <strong class="color">ofertas</strong> nuevas.</span>
						</h3>
					</div>
				</div>
			</div>

			<!-- Search Bar -->
			<div class="row">
				<div class="col-md-12">
					<div class="intro-banner-search-form margin-top-95">

						<!-- Search Field -->
						<div class="intro-search-field">
							<label for ="intro-keywords" class="field-title ripple-effect">¿Qué estas buscando?</label>
							<input id="intro-keywords" type="text" placeholder="Ej. Desarrollador .Net">
						</div>

						<!-- Search Field -->
						<div class="intro-search-field">
							<label for="autocomplete-input" class="field-title ripple-effect">¿Dónde?</label>
							<div class="input-with-icon">
								<input id="autocomplete-input" type="text" placeholder="¿En qué estado estas buscando?">
								<i class="icon-material-outline-location-on"></i>
							</div>
						</div>

						<!-- Button -->
						<div class="intro-search-button">
							<button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-full-page-map.html'">Buscar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Últimas vacantes --}}
	@if (count($vacancies) >= 5)
		<div class="section gray padding-top-65 padding-bottom-75">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<!-- Section Headline -->
						<div class="section-headline margin-top-0 margin-bottom-35">
							<h3>Últimas vacantes</h3>
							<a href="jobs-list-layout-full-page-map.html" class="headline-link">Todas las vacantes</a>
						</div>

						{{-- Jobs --}}
						<div class="listings-container compact-list-layout margin-top-35">
							@foreach ($vacancies as $vacancy)
								<a href="{{ url('vacante/'.$vacancy['id']) }}" class="job-listing with-apply-button">
									<!-- Job Listing Details -->
									<div class="job-listing-details">

										<!-- Logo -->
										<div class="job-listing-company-logo">
											@if ($vacancy['company_profile'] == '')
												<img src="{{ asset('hireo/images/company-logo-05.png') }}" alt="">
											@else
												<img src="{{ asset('storage/recruiter/companies/'. $vacancy['company_id'].'/'.$vacancy['company_profile']) }}" alt="">
											@endif
										</div>

										<!-- Details -->
										<div class="job-listing-description">
											<h3 class="job-listing-title">{{ $vacancy['job_title'] }}</h3>

											<!-- Job Listing Footer -->
											<div class="job-listing-footer">
												<ul>
													<li><i class="icon-material-outline-business"></i> {{ $vacancy['company_name'] }}</li>
													<li><i class="icon-material-outline-location-on"></i> {{ $vacancy['job_location'] }}</li>
													<li><i class="icon-material-outline-business-center"></i> {{ ucwords($vacancy['job_type']) }}</li>
													<li><i class="icon-material-outline-access-time"></i> {{ ($vacancy['created_at'] == 1) ? '1 día' : $vacancy['created_at'].' días' }}</li>
												</ul>
											</div>
										</div>

										<!-- Apply Button -->
										<span class="list-apply-button ripple-effect">Ver detalle</span>
									</div>
								</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
@stop