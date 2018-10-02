@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Perfil de empresa.')

{{-- Content --}}
@section('content')
	<div class="single-page-header" data-background-image="{{ asset('hireo/images/single-company.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-page-header-inner">
						<div class="left-side">
							<div class="header-image">
								@if ($company->profile_picture != '')
									<img src="{{ asset('storage/recruiter/companies/'.$company->id.'/'.$company->profile_picture) }}" alt="">
								@else
									<img src="{{ asset('hireo/images/company-logo-05.png') }}" alt="">
								@endif
							</div>
							<div class="header-details">
								<h3>{{ $company->name }} <span>Software House</span></h3>
								<ul>
									<li><div class="star-rating" data-rating="4.9"></div></li>
									{{--<li><img class="flag" src="images/flags/de.svg" alt=""> Germany</li>--}}
									<li><div class="verified-badge-with-title">Verified</div></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8 content-right-offset">
				<div class="single-page-section">
					<h3 class="margin-bottom-25">Acerca de {{ $company->name }}</h3>
					<p>{{ $company->about }}</p>
				</div>

				<div class="boxed-list margin-bottom-60">
					<div class="boxed-list-headline">
						<h3><i class="icon-material-outline-business-center"></i> Vacantes</h3>
					</div>

					<div class="listings-container compact-list-layout">
						{{-- jobs --}}
						@foreach ($vacancies as $vacancy)
							<a href="{{ url('vacante/'.$vacancy->id) }}" class="job-listing">
								<div class="job-listing-details">
									<div class="job-listing-description">
										<h3 class="job-listing-title">{{ $vacancy->job_title }}</h3>

										<p style="font-size: .8rem; line-height: 1.3rem; padding-bottom: .5rem;">
											{{ $vacancy->job_small_description }}
										</p>

										<!-- Job Listing Footer -->
										<div class="job-listing-footer">
											<ul>
												<li><i class="icon-material-outline-location-on"></i> {{ $vacancy->state->name }}</li>
												<li><i class="icon-material-outline-business-center"></i> {{ ucwords($vacancy->jobType->name) }}</li>
												<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
											</ul>
										</div>
									</div>
								</div>

								<!-- Bookmark -->
								<span class="bookmark-icon"></span>
							</a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@stop