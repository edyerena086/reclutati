@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Mi Curriculum')

{{-- Section Title --}}
@section('sectionTitle', 'Mi Curriculum')

{{-- Content --}}
@section('content')
	<div class="row">

		{{-- General Info --}}
		@include('front.candidate.dashboard.curriculum.partials._general-form')

		{{-- Contact info --}}
		@include('front.candidate.dashboard.curriculum.partials._contact-form')
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/candidate/dashboard/curriculum.js') }}"></script>
@stop