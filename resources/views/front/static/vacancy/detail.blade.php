@extends('layouts.front.app');

{{-- Page Title --}}
@section('pageTitle', 'Bolsa de trabajo para profesionales de TI')

{{-- Content --}}
@section('content')
	<div class="single-page-header" data-background-image="{{ asset('hireo/images/single-job.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-page-header-inner">
						<div class="left-side">
							<div class="header-image"><a href="single-company-profile.html"><img src="{{ asset('hireo/images/company-logo-03a.png') }}" alt=""></a></div>
							<div class="header-details">
								<h3>{{ $vacancy->job_title }}</h3>
								<h5>About the Employer</h5>
								<ul>
									<li><a href="single-company-profile.html"><i class="icon-material-outline-business"></i> King</a></li>
									<li><div class="star-rating" data-rating="4.9"></div></li>
									<li><img class="flag" src="{{ asset('hireo/images/flags/gb.svg') }}" alt=""> United Kingdom</li>
									<li><div class="verified-badge-with-title">Verified</div></li>
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
@stop