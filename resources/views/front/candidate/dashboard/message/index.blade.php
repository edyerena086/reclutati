@extends('layouts.front.candidate')

{{-- Page Title --}}
@section('pageTitle', 'Mis Mensaje')

{{-- Section Title --}}
@section('sectionTitle', 'Mis Mensajes')

{{-- Action button --}}
@section('actionButton')
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li>
				<a href="{{ url('recruiter/dashboard/vacancies/create') }}">
					<i class="icon-material-outline-add-circle-outline"></i> Crear vacante
				</a>
			</li>
		</ul>
	</nav>
@stop

{{-- Content --}}
@section('content')
	<div class="messages-container margin-top-0">
		<div class="messages-container-inner">
			{{-- Message --}}
			<div class="messages-inbox">
				<ul>
					@foreach ($messages as $message)
						<li>
							<a href="#">
								<div class="message-avatar"><i class="status-icon status-online"></i>
									<img src="{{ asset('storage/recruiter/companies/'.$message->senders->recruiter->companyContact->companies->id.'/'.$message->senders->recruiter->companyContact->companies->profile_picture) }}" alt="" />
								</div>

								<div class="message-by">
									<div class="message-by-headline">
										<h5>{{ ucwords($message->senders->name.' '.$message->senders->recruiter->last_name) }}</h5>
										<span>{{ $message->created_at->format('d/m/Y') }}</span>
									</div>
									<p>{{ $message->title }}</p>
								</div>
							</a>
						</li>
					@endforeach
				</ul>
			</div>

			{{-- Message Content --}}
			<div class="message-content">
				<div class="messages-headline">
					<h4>{{ @ucwords($messages->get(0)->senders->name.' '.$messages->get(0)->senders->recruiter->last_name) }}</h4>
					<a href="#" class="message-action"><i class="icon-feather-trash-2"></i> Delete Conversation</a>
				</div>

				{{-- Cuerpo del mensaje --}}
				<div class="message-content-inner">
					<div class="message-bubble">
						<div class="message-bubble-inner">
							<div class="message-avatar"><img src="{{ @asset('storage/recruiter/companies/'.$messages->get(0)->senders->recruiter->companyContact->companies->id.'/'.$messages->get(0)->senders->recruiter->companyContact->companies->profile_picture) }}" alt="" /></div>
							<div class="message-text"><p>{{ @$messages->get(0)->message }}</p></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				{{-- Reply area --}}
				<div class="message-reply">
					<textarea cols="1" rows="1" placeholder="Tu mensaje" data-autoresize></textarea>
					<button class="button ripple-effect">Enviar</button>
				</div>
			</div>
		</div>
	</div>
@stop