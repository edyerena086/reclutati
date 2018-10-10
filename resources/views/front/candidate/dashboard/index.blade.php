@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-6">
			{{-- Vacancy applied --}}
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3><i class="icon-brand-wpforms"></i> Últimas vacantes aplicadas</h3>
				</div>

				<div class="container">
					<ul class="dashboard-box-list">
						@foreach ($appliedVacancies as $vacancy)
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
						@endforeach
					</ul>
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
					<ul class="dashboard-box-list">
						@foreach ($savedVacancies as $vacancy)
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
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-6">
			<div class="dashboard-box">
				<div class="headline">
					<h3><i class="icon-material-baseline-notifications-none"></i> Notificaciones</h3>
					<button class="mark-as-read ripple-effect-dark" data-tippy-placement="left" title="Marcar todas como leídas">
							<i class="icon-feather-check-square"></i>
					</button>
				</div>

				<div class="content">
					<ul class="dashboard-box-list">
						@foreach (Auth::user()->unreadNotifications as $notification)
							
							<li>
								<span class="notification-icon"><i class="{{ $notification->data['icon'] }}"></i></span>
								<span class="notification-text">
									<a href="{{ url('notification/mark-as-read/'.Auth::user()->id.'/'.$notification->id.'/y') }}">
										{{ $notification->data['message'] }}
									</a>
								</span>
								
								<!-- Buttons -->
								<div class="buttons-to-right">
									<a href="{{ url('notifications/mark-as-read/'.Auth::user()->id.'/'.$notification->id) }}" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
								</div>
							</li>

						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop