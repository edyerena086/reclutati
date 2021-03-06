@extends('layouts.front.app')

{{-- SEO --}}
@section('seo')
	<meta name="description" content="ReclutaTI es una bolsa de trabajo para profesionales en TI, busca y aplica para las mejores vacantes en tecnologías de información en México.">

	<meta name="keywords" content="bolsa de trabajo, vacantes de empleo, ofertas de trabajo, vacantes de trabajo, portal de empleo">
@stop

{{-- Facebook Opengraph --}}
@section('facebook')
	<meta property="og:title" content="Bolsa de trabajo para profesionales en TI - ReclutaTI" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://reclutati.com/" />
	<meta property="og:image" content="https://reclutati.com/images/icono.png" />
	<meta property="og:image:height" content="150" />
	<meta property="og:image:width" content="150" />
	<meta property="og:site_name" content="Bolsa de Trabajo para profesionales en TI - ReclutaTI"/>
	<meta property="og:description" content="ReclutaTI es una bolsa de trabajo para profesionales en TI, busca y aplica para las mejores vacantes en tecnologías de información en México." />
@stop

{{-- Twitter data structure --}}
@section('twitter')
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:url" content="https://reclutati.com" />
	<meta name="twitter:title" content="Bolsa de trabajo para profesionales en TI - ReclutaTI" />
	<meta name="twitter:description" content="ReclutaTI es una bolsa de trabajo para profesionales en TI, busca y aplica para las mejores vacantes en tecnologías de información en México." />
	<meta name="twitter:image" content="https://reclutati.com/images/icono.png" />
@stop

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
						<h1>
							<strong>Bolsa de trabajo para los profesionales en TI.</strong>
							<br>
							<span>Todos los días encontrarás nuevas <strong class="color">vacantes de trabajo.</strong></span>
						</h1>
					</div>
				</div>
			</div>

			<!-- Search Bar -->
			<div class="row">
				<div class="col-md-12">
					<form action="{{ url('buscar/vacante') }}" method="GET" autocomplete="off">
						<div class="intro-banner-search-form margin-top-95">
							<!-- Search Field -->
							<div class="intro-search-field">
								<label for ="intro-keywords" class="field-title ripple-effect">¿Qué estas buscando?</label>
								<input id="intro-keywords" name="string" type="text" placeholder="Ej. Desarrollador .Net medio tiempo">
							</div>

							<!-- Search Field -->
							<div class="intro-search-field">
								<label for="autocomplete-input" class="field-title ripple-effect">¿Dónde?</label>
								<div class="input-with-icon">
									<input id="autocomplete-input" name="state" type="text" placeholder="¿En qué estado estas buscando?">
									<i class="icon-material-outline-location-on"></i>
								</div>
							</div>

							<!-- Button -->
							<div class="intro-search-button">
								<button type="submit" class="button ripple-effect">Buscar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- Últimas vacantes --}}
	@if (count($vacancies) >= 1)
		<div class="section gray padding-top-65 padding-bottom-75">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<!-- Section Headline -->
						<div class="section-headline margin-top-0 margin-bottom-35">
							<h3>Últimas vacantes</h3>
							<a href="{{ url('buscar/vacante') }}" class="headline-link">Todas las vacantes</a>
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
												<img src="{{ asset('hireo/images/company-logo-05.png') }}" alt="{{ $vacancy['company_name'] }} - Bolsa de trabajo">
											@else
												<img src="{{ asset('storage/recruiter/companies/'. $vacancy['company_id'].'/'.$vacancy['company_profile']) }}" alt="Imagen sin mostrar - Bolsa de trabajo">
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
													{{--<li><i class="icon-material-outline-access-time"></i> {{ ($vacancy['created_at'] == 1) ? '1 día' : $vacancy['created_at'].' días' }}</li>--}}
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

{{-- Page JS --}}
@section('pageJS')
	<!-- Datos estructurados -->
	<script type="application/ld+json">
	    {
	        "@context" : "http://schema.org",
	        "@type" : "WebSite",
	        "name" : "ReclutaTI - Bolsa de trabajo para profesionales de TI.",
	        "url" : "https://reclutati.com",
	        "sameAs": [
	            "https://twitter.com/reclutaTImx",
	            "https://www.facebook.com/reclutaTImx"
	        ],
	        "potentialAction": {
	        	"@type": "SearchAction",
	        	"target": "https://reclutati.com/buscar/vacante?string={search_term_string}",
			    //"target": "https://query.example.com/search?q={search_term_string}",
			    "query-input": "required name=search_term_string"
	        }
	        /*"address": {
	            "@type": "PostalAddress",
	            "streetAddress": "Blvd. Antonio L. Rodriguez #1888",
	            "addressRegion": "NL",
	            "postalCode": "64650",
	            "addressCountry": "MX"
	        }*/
	    }
	</script>
@stop