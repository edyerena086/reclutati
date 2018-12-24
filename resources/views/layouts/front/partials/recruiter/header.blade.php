<header id="header-container" class="fullwidth dashboard-header not-sticky">
	<div id="header">
		<div class="container">
			{{-- Left Side --}}
			<div class="left-side">
				<div id="logo">
					<a href="{{ url('/') }}"><img src="{{ asset('hireo/images/logo.png') }}" alt=""></a>
				</div>

				{{-- menu nav --}}
				<nav id="navigation">
					<ul id="responsive">
						<li>
							<a href="{{ url('recruiter/dashboard') }}">Dashboard</a>
						</li>

						<li>
							<a href="{{ url('recruiter/dashboard/vacancies/create') }}">Publicar Vacante</a>
						</li>

						<li>
							<a href="{{ url('recruiter/dashboard/candidates/search') }}">Buscar Candidatos</a>
						</li>

						{{--<li>
							<a href="{{ url('recruiter/dashboard/candidates/saved') }}">Candidatos guardados</a>
						</li>--}}

						<li>
							<a href="{{ url('recruiter/account/logout') }}">Cerrar sesión</a>
						</li>
					</ul>
				</nav>
			</div>

			{{-- Right side --}}
			<div class="right-side">
				{{-- notifications --}}
				<div class="header-widget hide-on-mobile">
					<div class="header-notifications">
						<!-- Trigger -->
						<div class="header-notifications-trigger">
							<a href="{{ url('notifications/all-mark-as-read') }}" id="displayNotifications"><i class="icon-feather-bell"></i><span id="notyCounter">{{ Auth::user()->unreadNotifications->count() }}</span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">
							<div class="header-notifications-headline">
								<h4>Notificaciones</h4>
								{{--<button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>--}}
							</div>

							{{-- notifications body --}}
							<div class="header-notifications-content">
								<div class="header-notifications-scroll" data-simplebar>
									<ul id="notyHeaderList">
										<!-- Notification -->
										@foreach(Auth::user()->unreadNotifications as $notification)
											<li class="notifications-not-read">
												<a href="{{ $notification->data['url'] }}" class="no-send-lnk">
													<span class="notification-icon"><i class="{{ $notification->data['icon'] }}"></i></span>
													<span class="notification-text">
														{{ $notification->data['message_to_display'] }}
													</span>
												</a>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>