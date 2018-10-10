@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Vacantes por estado.')

{{-- Page CSS --}}
@section('pageCSS')
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('js/plugin/shareButton/jssocials.css') }}" />
	<link rel="stylesheet" href="{{ asset('js/plugin/shareButton/jssocials-theme-flat.css') }}" />
@stop

{{-- Content --}}
@section('content')
	<div class="section margin-top-65">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="section-headline centered margin-bottom-15">
						<h3>Vacantes por estado</h3>
					</div>

					<div class="categories-container">
						@foreach ($states as $state)
							<a href="{{ url('buscar/vacante?state='.$state->name) }}" class="category-box">
								<div class="category-box-icon">
									<i class="icon-line-awesome-file-code-o"></i>
								</div>
								<div class="category-box-counter">{{ $state->vacancies->count() }}</div>
								<div class="category-box-content">
									<h3>{{ $state->name }}</h3>
								</div>
							</a>
						@endforeach
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