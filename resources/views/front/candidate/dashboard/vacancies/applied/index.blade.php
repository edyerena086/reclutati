@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Mis Vacantes Aplicadas')

{{-- Section Title --}}
@section('sectionTitle', 'Mis Vacantes Aplicadas')

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
						@foreach ($vacancies as $vacancy)
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

											<p>
												{{ $vacancy->vacancy->job_small_description }}
											</p>

											<div class="job-listing-footer">
												<ul style="padding-top: 1rem;">
													<li>
														<i class="icon-material-outline-date-range"></i> Creada: {{ $vacancy->vacancy->created_at->format('s/m/Y') }}</li>
													</li>

													<li>
														<i class="icon-material-outline-date-range"></i> Expira el {{ $vacancy->vacancy->created_at->addDays(30)->format('s/m/Y') }}</li>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right always-visible">
									<a href="{{ url('vacante/'.$vacancy->vacancy->id) }}" target="_blank" class="button ripple-effect"><i class="icon-feather-eye"></i> Ver vacante </a>

									<a href="{{ url('candidate/dashboard/vacancies/applied/'.$vacancy->vacancy->id) }}" class="button gray ripple-effect ico btn-vacancy-remove" title="Dejar de aplicar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>

			{{ $vacancies->links() }}
		</div>		
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/candidate/dashboard/vacancies/applied.js') }}"></script>
@stop