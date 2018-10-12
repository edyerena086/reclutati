@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Section Title --}}
@section('sectionTitle', 'Dashboard')

{{-- Content --}}
@section('content')
	@if ($company['recruiter_main_contact'] == true)
		<div class="row">
			<div class="col-xl-12">
				<div class="dashboard-box margin-top-0">
					<!-- Headline -->
					<div class="headline">
						<h3><i class="icon-line-awesome-building-o"></i> Empresa</h3>
						<p>
							Actualiza el logo de tu empresa, así como sus datos generales
						</p>
					</div>

					<div class="content with-padding padding-bottom-0">
						<div class="row">
							<div class="col-xl-3">
								<div class="avatar-wrapper" data-tippy-placement="bottom" title="Cambiar imagen">
									@if ($company['company_profile'] == '')
										<img class="profile-pic" src="{{  asset('hireo') }}/images/user-avatar-placeholder.png" alt="" />
									@else
										<img class="profile-pic" src="{{  asset('storage/recruiter/companies/'.$company['company_id'].'/'.$company['company_profile']) }}" alt="" />
									@endif
									<div class="upload-button"></div>
									<input class="file-upload" data-url="{{ url('recruiter/dashboard/company/profile-picture') }}" type="file" id="profilePicture" accept="image/*"/>
								</div>
							</div>

							<div class="col-xl-9">
								<form id="frmCompany" action="{{ url('recruiter/dashboard/company/update') }}" method="POST">
									<div class="row">
										<div class="col-xl-6">
											<div class="submit-field">
												<h5>*Nombre de empresa:</h5>
												<input type="text" name="empresa" class="with-border" value="{{ $company['company_name'] }}">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>*Teléfono <span>No será publico</span>:</h5>
												<input type="text" name="telefono" class="with-border" value="{{ Auth::user()->recruiter->validation_phone }}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-12">
											<div class="submit-field">
												<h5>Acerca de:</h5>
												<textarea name="acercaDe" cols="30" rows="5" class="with-border">{{ $company['company_about'] }}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xl-12">
											<div class="notification error closable hidden display-errors">
												<p>
													Se han cometido los siguientes errores:
												</p>

												<ul>
												</ul>
											</div>
										</div>
									</div>

									<div class="row">
										{{-- button --}}
										<div class="col-xl-12" style="margin-bottom: 1rem;">
											<button class="button ripple-effect big">
												Guardar
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	@endif

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
	<script src="{{ asset('js/front/recruiter/dashboard/company/profile-picture.js') }}"></script>
	<script src="{{ asset('js/front/recruiter/dashboard/company/form.js') }}"></script>
@stop