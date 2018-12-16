@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Mi empresa')

{{-- Section Title --}}
@section('sectionTitle', 'Mi empresa')

{{-- Content --}}
@section('content')
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
									@if ($company->profile_picture == '')
										<img class="profile-pic" src="{{  asset('hireo') }}/images/user-avatar-placeholder.png" alt="" />
									@else
										<img class="profile-pic" src="{{  asset('storage/recruiter/companies/'.$company->id.'/'.$company->profile_picture) }}" alt="" />
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
												<input type="text" name="empresa" class="with-border" value="{{ $company->name }}">
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
												<textarea name="acercaDe" cols="30" rows="5" class="with-border">{{ $company->about }}</textarea>
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
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/dashboard/company/profile-picture.js') }}"></script>
	<script src="{{ asset('js/front/recruiter/dashboard/company/form.js') }}"></script>
@stop