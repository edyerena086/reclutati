@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Configuración')

{{-- Section Title --}}
@section('sectionTitle', 'Configuración')

{{-- Content --}}
@section('content')
	<div class="row">

		{{-- Password --}}
		@include('front.candidate.dashboard.settings.partials._password-form')
	</div>
@stop