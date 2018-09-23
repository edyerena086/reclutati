<!doctype html>
<html lang="es">
<head>
	{{-- Page Title --}}
	<title>
		@yield('pageTitle') - {{ config('app.name', 'ReclutaTI') }}
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="base-url" content="{{ url('/') }}">

	{{-- CSS --}}
	<link rel="stylesheet" href="{{ asset('hireo/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('hireo/css/colors/blue.css') }}">
	<link rel="stylesheet" href="{{ asset('js/front/plugins/sticky-alerts/jnoty.css') }}">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
	
<body class="gray">
	<div id="wrapper">
		{{-- Heder --}}
		@include('layouts.front.partials.recruiter.header')

		{{-- Dashboard Content --}}
		<div class="dashboard-container">
			{{-- Sidebar --}}
			@include('layouts.front.partials.recruiter.sidebar')

			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">
					<div class="dashboard-headline">
						<h3>
							@yield('sectionTitle')
						</h3>
					</div>

					{{-- Content --}}
					@yield('content')

					{{-- Footer --}}
					@include('layouts.front.partials.recruiter.footer')
				</div>
			</div>
		</div>
	</div>
	

	{{-- JS --}}
	<script src="{{ asset('hireo/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('hireo/js/jquery-migrate-3.0.0.min.js') }}"></script>
	<script src="{{ asset('hireo/js/mmenu.min.js') }}"></script>
	<script src="{{ asset('hireo/js/tippy.all.min.js') }}"></script>
	<script src="{{ asset('hireo/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('hireo/js/bootstrap-slider.min.js') }}"></script>
	<script src="{{ asset('hireo/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('hireo/js/snackbar.js') }}"></script>
	<script src="{{ asset('hireo/js/clipboard.min.js') }}"></script>
	<script src="{{ asset('hireo/js/counterup.min.js') }}"></script>
	<script src="{{ asset('hireo/js/magnific-popup.min.js') }}"></script>
	<script src="{{ asset('hireo/js/slick.min.js') }}"></script>
	<script src="{{ asset('hireo/js/custom.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
	<script src="{{ asset('js/front/plugins/sticky-alerts/jnoty.js') }}"></script>
	<script src="{{ asset('js/pastora.js') }}"></script>

	{{-- Page JS --}}
	@section('pageJS')
	@show
</body>
</html>