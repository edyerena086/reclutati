@extends('layouts.front.recruiter')

{{-- Page Title --}}
@section('pageTitle', 'Administrar Candidatos')

{{-- Section Title --}}
@section('sectionTitle', 'Administrar Candidatos')

{{-- Section SubTitle --}}
@section('sectionSubTitle')
	<span class="margin-top-7">Candidatos aplicarón a: <a href="{{ url('recruiter/dashboard/vacancies/'.$vacancy['vacancy_id']) }}" target="_blank">{{ $vacancy['name'] }}</a></span>
@stop

{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				<!-- Headline -->
				<div class="headline">
					<h3 class="candidateCounter"><i class="icon-material-outline-supervisor-account"></i> {{ ($vacancy['count'] == 1) ? '1 Candidato' : $vacancy['count'].' Candidatos' }}</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list">
						@foreach ($vacancy['candidates'] as $candidate)
							<li class="candidate-item">
								<div class="freelancer-overview manage-candidates">
									<div class="freelancer-overview-inner">
										{{-- avatar --}}
										<div class="freelancer-avatar">
											<a href="{{ url('recruiter/dashboard/candidate/'.$candidate['id'].'/curriculum') }}">
												@if ($candidate['profile_picture'] == '')
													<img src="{{ asset('hireo/images/user-avatar-placeholder.png') }}" alt="">
												@else
													<img src="{{ asset('storage/candidates/'.$candidate['id'].'/'.$candidate['profile_picture']) }}" alt="">
												@endif
											</a>
										</div>

										{{-- body --}}
										<div class="freelancer-name">
											<h4>
												<a href="{{ url('recruiter/dashboard/candidate/'.$candidate['id'].'/curriculum') }}">
													{{ $candidate['name'] }}
												</a>
											</h4>

											<span class="freelancer-detail-item"><a href="mailto:{{$candidate['email']}}"><i class="icon-feather-mail"></i> {{ $candidate['email'] }}</a></span>

											@if ($candidate['cellphone'] != '')
												<span class="freelancer-detail-item"><i class="icon-feather-phone"></i> {{ $candidate['cellphone'] }}</span>
											@endif

											{{-- buttons --}}
											<div class="buttons-to-right always-visible margin-top-25 margin-bottom-5">
												<a href="{{ url('recruiter/dashboard/candidates/detail/'.$candidate['id']) }}" target="_blank" class="button ripple-effect"><i class="icon-feather-file-text"></i> Ver curriculum</a>

												<a href="#small-dialog-1" data-url="{{ url('recruiter/dashboard/vacancies/cadndidates/message/'.$candidate['id']) }}" class="popup-with-zoom-anim button dark btn-send-message ripple-effect"><i class="icon-feather-mail"></i> Mandar mensaje</a>

												<a href="{{ url('recruiter/dashboard/candidate/'.$candidate['id'].'/'.$vacancy['vacancy_id'].'/remove') }}" class="button remove-candidate gray ripple-effect ico" title="Remover candidato" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
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

		{{-- message popup form --}}
		<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
			{{-- tabs --}}
			<div class="sign-in-form">
				<ul class="popup-tabs-nav">
				</ul>

				{{-- tab content --}}
				<div class="popup-tab-content" id="tab2">
					<div class="welcome-text">
						<h3 class="educative-title">Nuevo mensaje</h3>
						<span>Los campos marcados con (*) son obligatorios.</span>
					</div>

					{{-- form --}}
					<form id="frmMessage" class="not-index" data-action="store" method="post" action="{{ url('recruiter/dashboard/vacancies/cadndidates/message/') }}">
						<div class="row">
							<div class="col-xl-12">
								<strong>*Título:</strong>
								<input type="text" name="title" class="with-border">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>*Mensaje:</strong>
								<textarea class="with-border" name="message" cols="7"></textarea>
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

						<button class="button full-width button-sliding-icon ripple-effect" type="submit">Enviar<i class="icon-material-outline-arrow-right-alt"></i></button>
					</form>
				</div>
			</div>
		</div>
@stop

{{-- JS Page --}}
@section('pageJS')
	<script src="{{ asset('js/front/recruiter/dashboard/vacancy/candidate/index.js') }}"></script>
@stop