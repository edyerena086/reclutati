@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	<div class="single-page-header freelancer-header" data-background-image="{{ asset('hireo/images/single-freelancer.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="single-page-header-inner">
						<div class="left-side">
							{{-- profile picture --}}
							<div class="header-image freelancer-avatar"><img src="images/user-avatar-big-02.jpg" alt=""></div>
							<div class="header-details">
								<h3>David Peterson <span>iOS Expert + Node Dev</span></h3>
								<ul>
									<li><div class="star-rating" data-rating="5.0"></div></li>
									<li><img class="flag" src="images/flags/de.svg" alt=""> Germany</li>
									<li><div class="verified-badge-with-title">Verified</div></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

{{-- JS Page --}}
@section('pageJS')
@stop