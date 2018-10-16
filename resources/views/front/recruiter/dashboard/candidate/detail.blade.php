@extends('layouts.front.app')

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
								<h3>{{ ucwords($candidate->user->name.' '.$candidate->last_name) }} <span>{{ $candidate->user->email }}</span></h3>
								<ul>
									<li>Cel: {{ ($candidate->cellphone == '') ? 'Sin especificar' : $candidate->cellphone }}</li>
									<li>
										Edad: {{ $candidate->age }}
									</li>
									<li><div class="verified-badge-with-title">Verificado</div></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Content --}}
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8 content-right-offset">
				{{-- Labor goal --}}
				<div class="single-page-section">
					<h3 class="margin-bottom-25">Objetivo laboral</h3>
					<p>{{ $candidate->labor_goal }}</p>
				</div>

				{{-- Job history --}}
				<div class="boxed-list margin-bottom-60">
					<div class="boxed-list-headline">
						<h3><i class="icon-material-outline-business"></i> Historial laboral</h3>
					</div>

					<ul class="boxed-list-ul">
						@foreach ($candidate->jobHistories as $history)
							<li>
								<div class="boxed-list-item">
									<!-- Content -->
									<div class="item-content">
										<h4>{{ $history->job_title }} <span>{{ $history->company_name }}</span></h4>
										<div class="item-details margin-top-10">
											<div class="detail-item"><i class="icon-material-outline-date-range"></i> Tiempo: {{ $history->duration }} años</div>
										</div>
										<div class="item-description">
											<p>{{ $history->description }}</p>
										</div>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>

				{{-- Job history --}}
				<div class="boxed-list margin-bottom-60">
					<div class="boxed-list-headline">
						<h3><i class="icon-material-outline-school"></i> Educación</h3>
					</div>

					<ul class="boxed-list-ul">
						@foreach ($candidate->educativeHistories as $history)
							<li>
								<div class="boxed-list-item">
									<!-- Content -->
									<div class="item-content">
										<h4>{{ $history->degree }} <span>{{ ucwords($history->school_name) }}</span></h4>
										<div class="item-details margin-top-10">
											<div class="detail-item"><i class="icon-line-awesome-chevron-circle-down"></i> Nivel educativo: {{ ucwords($history->educationLevel->name) }}</div>
										</div>
										<div class="item-description">
											<p>{{ $history->description }}</p>
										</div>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>

			{{-- lateral column --}}
			<div class="col-xl-4 col-lg-4">
				<div class="sidebar-container">
					{{-- languages --}}
					<div class="sidebar-widget">
						<h3>Idiomas</h3>

						<div class="freelancer-indicators">

							@foreach ($candidate->languages as $language)
								<div class="indicator">
									<strong>{{ $language->percent }}%</strong>
									<div class="indicator-bar" data-indicator-percentage="{{ $language->percent }}"><span></span></div>
									<span>{{ ucwords($language->languageName->name) }}</span>
								</div>
							@endforeach
						</div>
					</div>

					{{-- skills --}}
					<div class="sidebar-widget">
						<h3>
							Hábilidades
						</h3>

						<div class="task-tags">
							@foreach ($candidate->skills as $skill)
								<span>{{ $skill->skill }}</span>
							@endforeach
						</div>
					</div>

					{{-- social profiles --}}
					<div class="sidebar-widget">
						<h3>Redes sociales</h3>
						
						<div class="freelancer-socials margin-top-25">
							<ul>
								@if ($candidate->twitter != '')
									<li><a href="{{ $candidate->twitter }}"  target="_blank" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								@endif

								@if ($candidate->facebook != '')
									<li><a href="{{ $candidate->facebook }}" target="_blank" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook"></i></a></li>
								@endif

								@if ($candidate->linkedin != '')
									<li><a href="{{ $candidate->linkedin }}" target="_blank" title="LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
								@endif

								@if ($candidate->website != '')
									<li><a href="{{ $candidate->website }}" target="_blank" title="Website" data-tippy-placement="top"><i class="icon-line-awesome-unlink"></i></a></li>
								@endif
							</ul>
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