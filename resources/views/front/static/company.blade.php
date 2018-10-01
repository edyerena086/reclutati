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
							<div class="header-image"><img src="{{ asset('hireo/images/browse-companies-03.png') }}" alt=""></div>
							<div class="header-details">
								<h3>Acodia <span>Software House</span></h3>
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
@stop