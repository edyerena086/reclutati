@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	<div class="row">
		{{-- Password --}}
		@include('front.recruiter.dashboard.settings.partials._password-form')
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/dashboard/settings.js') }}"></script>
@stop