<!doctype html>
<html lang="es">
<head>
	@if (App::environment('production'))
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127302744-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-127302744-1');
		</script>

		<!-- Facebook Pixel Code -->
		<script>
		  !function(f,b,e,v,n,t,s)
		  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		  n.queue=[];t=b.createElement(e);t.async=!0;
		  t.src=v;s=b.getElementsByTagName(e)[0];
		  s.parentNode.insertBefore(t,s)}(window, document,'script',
		  'https://connect.facebook.net/en_US/fbevents.js');
		  fbq('init', '256883418329142');
		  fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		  src="https://www.facebook.com/tr?id=256883418329142&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->

		{{-- Google Adsense --}}
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		  (adsbygoogle = window.adsbygoogle || []).push({
		    google_ad_client: "ca-pub-9609287947171057",
		    enable_page_level_ads: true
		  });
		</script>
	@endif

	{{-- SEO --}}
	@section('seo')
	@show

	{{-- Facebook data structure --}}
	@section('facebook')
	@show

	{{-- Twitter data structure --}}
	@section('twitter')
	@show

	{{-- Page Title --}}
	<title>
		@yield('pageTitle') - {{ config('app.name', 'ReclutaTI') }}
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- favicon --}}
	<link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

	{{-- CSS --}}
	<link rel="stylesheet" href="{{ asset('hireo/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('hireo/css/colors/blue.css') }}">
	<link rel="stylesheet" href="{{ asset('js/front/plugins/sticky-alerts/jnoty.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	{{-- Page CSS --}}
	@section('pageCSS')
	@show
</head>
	
<body>
	<div id="wrapper">
		{{-- Heder --}}
		@if (Auth::check() && Auth::user()->role_id == \ReclutaTI\Role::CANDIDATE)
			{{--@include('layouts.front.partials.header-candidate')--}}
			@include('layouts.front.partials.candidate.header')
		@elseif (Auth::check() && Auth::user()->role_id == \ReclutaTI\Role::RECRUITER)
			@include('layouts.front.partials.recruiter.header')
		@else
			@include('layouts.front.partials.header')
		@endif

		{{-- Content --}}
		@yield('content')

		{{-- Footer --}}
		@include('layouts.front.partials.footer')
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
	<script src="{{ asset('js/front/plugins/sticky-alerts/jnoty.js') }}"></script>
	<script src="{{ asset('js/pastora.js') }}"></script>
	<script src="{{ asset('js/front/notifications.js') }}"></script>

	{{-- Page JS --}}
	@section('pageJS')
	@show
</body>
</html>