@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	{{-- Notifications --}}
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box">
				<div class="headline">
					<h3><i class="icon-material-baseline-notifications-none"></i> Notificaciones</h3>
					<button class="mark-as-read ripple-effect-dark" data-url="{{ url('notifications/all-mark-as-read') }}" data-tippy-placement="left" title="Marcar todas como leídas">
							<i class="icon-feather-check-square"></i>
					</button>
				</div>

				<div class="content">
					<ul class="dashboard-box-list notifications-list">
						@foreach (Auth::user()->unreadNotifications as $notification)
							
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

						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

	{{-- Vacancies --}}
	<div class="row">
		<div class="col-xl-6">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3><i class="icon-brand-wpforms"></i> Últimas vacantes publicadas</h3>
				</div>

				<div class="container">
					<ul class="dashboard-box-list">
						@foreach ($vacancies as $vacancy)
							<li class="vacancy-item">
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title"><a href="{{ url('vacante/'.$vacancy->id) }}" target="_blank">
												{{ $vacancy->job_title }}</a>
											</h3>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right always-visible">
									<a href="{{ url('recruiter/dashboard/vacancies/candidates/'.$vacancy->id) }}" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Candidatos registrados <span class="button-info">{{ $vacancy->candidates->count() }}</span></a>

									<a href="{{ url('recruiter/dashboard/vacancies/'.$vacancy->id.'/edit') }}" class="button gray ripple-effect ico" title="Editar" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>

									<a href="{{ url('recruiter/dashboard/vacancies/'.$vacancy->id) }}" class="button gray ripple-effect ico" title="Ver" target="_blank" data-tippy-placement="top"><i class="icon-feather-eye"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

		{{-- Candidates --}}
		<div class="col-xl-6">
			<div class="dashboard-box main-box-in-row">
				<div class="headline">
					<h3><i class="icon-feather-user"></i> Últimos candidatos</h3>
				</div>

				<div class="container">
					<ul class="dashboard-box-list">
						@foreach ($candidatesApplied as $candidate)
							<li class="vacancy-item">
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title"><a href="{{ url('recruiter/dashboard/candidate/detail/'.$candidate->candidate->id) }}" target="_blank">
												{{ ucwords($candidate->candidate->user->name.' '.$candidate->candidate->last_name) }}</a>
											</h3>

											<ul class="list-3 color">
												<li>
													<strong>Vacante:</strong> {{ $candidate->vacancy->job_title }}
												</li>

												<li>
													<strong>Fecha de aplicación:</strong> {{ $candidate->vacancy->created_at->format('d/m/Y') }}
												</li>
											</ul>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right always-visible">
									<a href="{{ url('recruiter/dashboard/candidate/detail/'.$candidate->candidate->id) }}" class="button gray ripple-effect ico" title="Ver" target="_blank" data-tippy-placement="top"><i class="icon-feather-eye"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/dashboard/dashboard.js') }}"></script>
@stop