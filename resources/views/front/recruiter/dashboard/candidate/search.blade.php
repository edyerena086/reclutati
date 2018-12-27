@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	<div class="row">
		{{-- lateral sidebar --}}
		<div class="col-xl-3 col-lg-4">
			<form action="{{ url('recruiter/dashboard/candidates/search') }}" method="GET">
				<!-- Location -->
				<div class="sidebar-widget">
					<h3>Ubicación</h3>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input id="state" name="state" type="text" placeholder="Cualquier parte">
						</div>
						<i class="icon-material-outline-location-on"></i>
					</div>
				</div>

				{{-- Search query --}}
				<div class="sidebar-widget">
					<h3>Palabras clave</h3>
					<div class="keywords-container">
						<div class="keyword-input-container">
							<input type="text" name="string" class="keyword-input" placeholder="Ej. Desarrollador web"/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				{{-- Send button --}}
				<div class="sidebar-widget">
					<button class="button ripple-effect" style="width: 100%">
						Buscar
					</button>
				</div>
			</form>
		</div>

		{{-- candidates profiles --}}
		<div class="col-xl-9 col-lg-8 content-left-offset">
			<h3 class="page-title">Candidatos</h3>

			{{-- freelance list --}}
			<div class="freelancers-container freelancers-grid-layout margin-top-35">
				
				@foreach ($candidates as $candidate)
					<div class="freelancer">
						<!-- Overview -->
						<div class="freelancer-overview">
							<div class="freelancer-overview-inner">
								
								<!-- Bookmark Icon -->
								{{--<span class="bookmark-icon"></span>--}}
								
								<!-- Avatar -->
								<div class="freelancer-avatar">
									<div class="verified-badge"></div>
									@if ($candidate->candidate->profile_picture == '')
										<a href="{{ url('recruiter/dashboard/candidates/detail/'. $candidate->candidate_id) }}" target="_blank"><img src="{{ asset('hireo/images/user-avatar-placeholder.png') }}" alt=""></a>
									@else
										<a href="{{ url('recruiter/dashboard/candidates/detail/'. $candidate->candidate_id) }}" target="_blank"><img src="{{ asset('uploads/candidates/'.$candidate->candidate->id.'/'.$candidate->candidate->profile_picture) }}" alt=""></a>
									@endif
								</div>

								<!-- Name -->
								<div class="freelancer-name">
									<h4><a href="{{ url('recruiter/dashboard/candidates/detail/'. $candidate->candidate_id) }}" target="_blank">{{ ucwords($candidate->name) }} <img class="flag" src="images/flags/gb.svg" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
									<span>{{ $candidate->labor_goal }}</span>
								</div>

								<!-- Rating -->
								{{--<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>--}}
							</div>
						</div>
						
						<!-- Details -->
						<div class="freelancer-details">
							<div class="freelancer-details-list">
								<ul>
									<li>Ubicación <strong><i class="icon-material-outline-location-on"></i> {{ ($candidate->location == '') ? 'Sin especificar' : $candidate->location }}</strong></li>
									<li>Edad: <strong>{{ ($candidate->age == '') ? 'Sin especificar' : $candidate->age }}</strong></li>
									<li>
										Educación: <strong>{{ @$candidate->candidate->educativeHistories->first()->degree }}</strong>
									</li>
								</ul>
							</div>
							<a href="{{ url('recruiter/dashboard/candidates/detail/'. $candidate->candidate_id) }}" target="_blank" class="button button-sliding-icon ripple-effect">Ver perfil <i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
@stop