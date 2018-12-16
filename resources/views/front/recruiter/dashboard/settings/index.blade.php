@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Configuración')

{{-- Section Title --}}
@section('sectionTitle', 'Configuración')

{{-- Content --}}
@section('content')
	<div class="row">
		{{-- Email --}}
		@include('front.recruiter.dashboard.settings.partials._email-form')

		{{-- Password --}}
		@include('front.recruiter.dashboard.settings.partials._password-form')
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/dashboard/settings.js') }}"></script>
@stop