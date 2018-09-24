@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Mis Vacantes')

{{-- Section Title --}}
@section('sectionTitle', 'Mis Vacantes')

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
					<h3><i class="icon-material-outline-business-center"></i> Mis vacantes</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list">
						@foreach ($vacancies as $vacancy)
							<li>
								{{-- vacancy description --}}
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title"><a href="#">
												{{ $vacancy->job_title }}</a> 
												@if ($vacancy->publish)
													<span class="dashboard-status-button green">Publicada</span>
												@else
													<span class="dashboard-status-button yellow">No Publicada</span>
												@endif
											</h3>

											<p>
												Hola
												{{ $vacancy->job_small_description }}
											</p>

											<div class="job-listing-footer">
												<ul style="padding-top: 1rem;">
													<li>
														<i class="icon-material-outline-date-range"></i> Creada: {{ $vacancy->created_at->format('s/m/Y') }}</li>
													</li>

													<li>
														<i class="icon-material-outline-date-range"></i> Expira el {{ $vacancy->created_at->addDays(30)->format('s/m/Y') }}</li>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right always-visible">
									<a href="{{ url('recruiter/dashboard/vacancies/'.$vacancy->id) }}" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Manage Candidates <span class="button-info">0</span></a>
									<a href="{{ url('recruiter/dashboard/vacancies/'.$vacancy->id) }}" class="button gray ripple-effect ico" title="Editar" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
									<a href="#" class="button gray ripple-effect ico" title="Borrar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
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
@stop