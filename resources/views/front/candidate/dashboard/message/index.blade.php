@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Mis Mensaje')

{{-- Section Title --}}
@section('sectionTitle', 'Mis Mensaje')

{{-- Action button --}}
@section('actionButton')
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li>
				<a href="{{ url('recruiter/dashboard/vacancies/create') }}">
					<i class="icon-material-outline-add-circle-outline"></i> Crear vacante
				</a>
			</li>
		</ul>
	</nav>
@stop

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				<!-- Headline -->
				<div class="headline">
					<h3><i class="icon-material-outline-business-center"></i> Mis vacantes aplicadas</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list">
						
					</ul>
				</div>
			</div>
		</div>		
	</div>
@stop