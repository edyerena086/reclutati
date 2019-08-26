@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box">
				<div class="headline">
					<h3><i class="icon-material-baseline-notifications-none"></i> Notificaciones</h3>
					
					@if (Auth::user()->unreadNotifications->count())
						<button class="mark-as-read ripple-effect-dark" data-url="{{ url('notifications/all-mark-as-read') }}" data-tippy-placement="left" title="Marcar todas como leídas">
								<i class="icon-feather-check-square"></i>
						</button>
					@endif
				</div>

				<div class="content">
					
					@forelse (Auth::user()->unreadNotifications as $notification)
						<ul class="dashboard-box-list notifications-list">
							<li>
								<span class="notification-icon"><i class="{{ $notification->data['icon'] }}"></i></span>
								<span class="notification-text">
									<a href="{{ $notification->data['url'] }}" target="_blank">
										{{ $notification->data['message_to_display'] }}
									</a>
								</span>
								
								<!-- Buttons -->
								<div class="buttons-to-right">
									<a href="{{ url('notifications/mark-as-read/'.Auth::user()->id.'/'.$notification->id) }}" class="button ripple-effect ico btn-noty-mark-as-read" title="Marcar como leído" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
								</div>
							</li>
						</ul>

					@empty
							
							<ul class="dashboard-box-list">
								<li>No tienes ninguna notficación</li>
							</ul>

					@endforelse
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-6">
			{{-- Vacancy applied --}}
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3><i class="icon-brand-wpforms"></i> Últimas postulaciones</h3>
				</div>

				<div class="container">
					@forelse ($appliedVacancies as $vacancy)
						<ul class="dashboard-box-list">
							<li class="vacancy-item">
								{{-- vacancy description --}}
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title"><a href="{{ url('vacante/'.$vacancy->vacancy->id) }}" target="_blank">
												{{ $vacancy->vacancy->job_title }}</a> 
												<span class="dashboard-status-button green">
													{{ $vacancy->vacancy->recruiter->companyContact->companies->name}}
												</span>
											</h3>

											<div class="job-listing-footer">
												<ul style="padding-top: 1rem;">
													<li>
														<i class="icon-material-outline-date-range"></i> Creada: {{ $vacancy->vacancy->created_at->format('d/m/Y') }}</li>
													</li>

													<li>
														<i class="icon-material-outline-date-range"></i> Expira el {{ $vacancy->vacancy->created_at->addDays(30)->format('d/m/Y') }}</li>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					@empty
						<ul class="dashboard-box-list">
							<li>No tienes ninguna postulación</li>
						</ul>
					@endforelse
				</div>
			</div>
		</div>

		<div class="col-xl-6">
			{{-- Vacancy saved --}}
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3><i class="icon-line-awesome-star"></i> Últimas vacantes guardadas</h3>
				</div>

				<div class="container">
					@forelse ($savedVacancies as $vacancy)
						<ul class="dashboard-box-list">
							<li class="vacancy-item">
								{{-- vacancy description --}}
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title"><a href="{{ url('vacante/'.$vacancy->vacancy->id) }}" target="_blank">
												{{ $vacancy->vacancy->job_title }}</a> 
												<span class="dashboard-status-button green">
													{{ $vacancy->vacancy->recruiter->companyContact->companies->name}}
												</span>
											</h3>

											<div class="job-listing-footer">
												<ul style="padding-top: 1rem;">
													<li>
														<i class="icon-material-outline-date-range"></i> Creada: {{ $vacancy->vacancy->created_at->format('d/m/Y') }}</li>
													</li>

													<li>
														<i class="icon-material-outline-date-range"></i> Expira el {{ $vacancy->vacancy->created_at->addDays(30)->format('d/m/Y') }}</li>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					@empty
						<ul class="dashboard-box-list">
							<li>No tienes vacantes guardadas</li>
						</ul>
					@endforelse
				</div>
			</div>
		</div>
	</div>
@stop

{{-- Page JS --}}
@section('pageJS')
	<script src="{{ asset('js/front/candidate/dashboard/dashboard.js') }}"></script>
@stop