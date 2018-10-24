<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- Page Title --}}
	<title>
		@yield('pageTitle') - {{ config('app.name', 'ReclutaTI') }}
	</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/colors.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/notifications/pnotify.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/pages/components_notifications_pnotify.js"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/core/app.js"></script>

	{{-- DataTables --}}
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/pages/datatables_basic.js"></script>

	{{-- CSS Page --}}
	@section('pageCSS')
	@show

</head>

<body>

	@include('layouts.back.partials.top-navbar')


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			{{-- sidebar menu --}}
			@include('layouts.back.partials.sidebar')


			<!-- Main content -->
			<div class="content-wrapper" id="app">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-user position-left"></i> <span class="text-semibold">Dashboard</span> - @yield('bodyPageTitle')</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								@yield('headerPageButton')
							</div>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="{{ url('candidate/dashboard') }}"><i class="icon-home2 position-left"></i> Dashboard</a></li>
							{{--<li class="active">Dashboard</li>--}}
							@section('breadcrumbs')
							@show
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					@yield('content')					
					<!-- /dashboard content -->


					<!-- Footer -->
					<div class="footer text-muted">
						&copy; {{ \Carbon\Carbon::now()->year }}. <a href="#">Powered</a> by <a href="http://metodika.mx" target="_blank">Metodika IT</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	{{-- PageJS --}}
	@section('pageJS')
	@show
</body>
</html>