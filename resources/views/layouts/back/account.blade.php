<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- Page Title --}}
	<title>
		@yield('pageTitle') -  {{ ENV('APP_NAME') }}
	</title>

	{{-- Global styles --}}
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/limitless/assets/css/colors.css" rel="stylesheet" type="text/css">

	{{-- Core JS files --}}
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/notifications/pnotify.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/plugins/notifications/sweet_alert.min.js"></script>

	
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/pages/components_notifications_pnotify.js"></script>

	{{-- Theme JS files --}}
	<script type="text/javascript" src="{{ url('/') }}/limitless/assets/js/core/app.js"></script>
</head>

<body class="login-container">

	{{-- Header --}}
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="{{ url('/') }}/limitless/assets/images/logo_light.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>
	</div>

	{{-- Main Content --}}
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content">
					@yield('content')
				</div>
			</div>
		</div>
	</div>

	{{-- Page JS --}}
	@section('pageJS')
	@show
</body>
</html>