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
@stop