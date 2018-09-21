@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Mi Curriculum')

{{-- Section Title --}}
@section('sectionTitle', 'Mi Curriculum')

{{-- Content --}}
@section('content')
	<div class="row">

		{{-- Profile Picture --}}
		@include('front.candidate.dashboard.curriculum.partials._profile-picture-form')

		{{-- General Info --}}
		@include('front.candidate.dashboard.curriculum.partials._general-form')

		{{-- Contact info --}}
		@include('front.candidate.dashboard.curriculum.partials._contact-form')

		{{-- Address --}}
		@include('front.candidate.dashboard.curriculum.partials._address-form')

		{{-- Education and languages --}}
		@include('front.candidate.dashboard.curriculum.partials._education-language-form')

		{{-- Job histories and skills --}}
		@include('front.candidate.dashboard.curriculum.partials._job-history-skills-form')
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/candidate/dashboard/curriculum.js') }}"></script>
	<script src="{{ asset('js/front/candidate/dashboard/curriculum/profile-picture.js') }}"></script>
	<script src="{{ asset('js/front/candidate/dashboard/curriculum/education.js') }}"></script>
	<script src="{{ asset('js/front/candidate/dashboard/curriculum/languages.js') }}"></script>
	<script src="{{ asset('js/front/candidate/dashboard/curriculum/job-history.js') }}"></script>
@stop