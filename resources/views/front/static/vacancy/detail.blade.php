@extends('layouts.front.app');

{{-- Page Title --}}
@section('pageTitle', 'Vacante: '.$vacancy->job_title)

{{-- Content --}}
@section('content')
	<div class="single-page-header" data-background-image="{{ asset('hireo/images/single-job.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-page-header-inner">
						<div class="left-side">
							<div class="header-image">
								<a href="{{ url('empresa/'. $vacancy->recruiter->companyContact->companies->first()->id) }}">
									@if ($vacancy->recruiter->companyContact->companies->first()->profile_picture == '')
										<img src="{{ asset('hireo/images/company-logo-03a.png') }}" alt="">
									@else
										<img src="{{ asset('storage/recruiter/companies/'. $vacancy->recruiter->companyContact->companies->first()->id.'/'.$vacancy->recruiter->companyContact->companies->first()->profile_picture) }}" alt="">
									@endif
								</a>
							</div>
							<div class="header-details">
								<h3>{{ $vacancy->job_title }}</h3>
								<h5>{{ $vacancy->recruiter->companyContact->companies->first()->name }}</h5>
								<ul>
									{{--<li><a href="single-company-profile.html"><i class="icon-material-outline-business"></i> King</a></li>
									<li><div class="star-rating" data-rating="4.9"></div></li>
									<li><img class="flag" src="{{ asset('hireo/images/flags/gb.svg') }}" alt=""> United Kingdom</li>--}}
									<li><div class="verified-badge-with-title">Verificado</div></li>
								</ul>
							</div>
						</div>
						<div class="right-side">
							<div class="salary-box">
								<div class="salary-type">Annual Salary</div>
								<div class="salary-amount">$35k - $38k</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Job description --}}
	<div class="container">
		<div class="row">
			{{-- Content --}}
			<div class="col-xl-8 col-lg-8 content-right-offset">
				<div class="single-page-section">
					<h3 class="margin-bottom-25">Descripción de Vacante</h3>
					{!! $vacancy->job_description !!}
				</div>
			</div>

			{{-- sidebar --}}
			<div class="col-xl-4 col-lg-4">
				<div class="sidebar-container">
					@if (!Auth::check())
						<a href="#small-dialog" class="apply-now-button popup-with-zoom-anim">Aplica ahora <i class="icon-material-outline-arrow-right-alt"></i></a>
					@elseif (Auth::user()->role_id == \ReclutaTI\Role::CANDIDATE)
						<a href="#small-dialog" class="apply-now-button popup-with-zoom-anim">Aplica ahora <i class="icon-material-outline-arrow-right-alt"></i></a>
					@endif

					<div class="sidebar-widget">
						<div class="job-overview">
							<div class="job-overview-headline">Carácteristicas</div>
							<div class="job-overview-inner">
								<ul>
									<li>
										<i class="icon-material-outline-location-on"></i>
										<span>Ubicación</span>
										<h5>{{ $vacancy->state->first()->name }}</h5>
									</li>

									<li>
										<i class="icon-material-outline-business-center"></i>
										<span>Tipo de Vacante</span>
										<h5>{{ ucwords($vacancy->jobType->first()->name) }}</h5>
									</li>

									<li>
										<i class="icon-material-outline-school"></i>
										<span>Formación mínima</span>
										<h5>{{ ucwords($vacancy->educativeLevel->where('id', $vacancy->educative_level_id)->first()->name) }}</h5>
									</li>

									@if ($vacancy->salary_min != '' && $vacancy->salary_max != '')

										<li>
											<i class="icon-line-awesome-money"></i>
											<span>Salario</span>
											<h5>${{ $vacancy->salary_min }} - ${{ $vacancy->salary_max }}</h5>
										</li>

									@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop