@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Configuración')

{{-- Section Title --}}
@section('sectionTitle', 'Configuración')

{{-- Content --}}
@section('content')
	<div class="row">

		@if (Auth::user()->candidate->socialLogin == null)
			{{-- Email --}}
			@include('front.candidate.dashboard.settings.partials._email-form')

			{{-- Password --}}
			@include('front.candidate.dashboard.settings.partials._password-form')
		@endif
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/candidate/dashboard/settings.js') }}"></script>
@stop