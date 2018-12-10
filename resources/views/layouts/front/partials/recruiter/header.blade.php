<header id="header-container" class="fullwidth dashboard-header not-sticky">
	<div id="header">
		<div class="container">
			{{-- Left Side --}}
			<div class="left-side">
				<div id="logo">
					<a href="{{ url('recruiter/dashboard') }}"><img src="{{ asset('hireo/images/logo.png') }}" alt=""></a>
				</div>

				{{-- menu nav --}}
				<nav id="navigation">
					<ul id="responsive">
						<li>
							<a href="{{ url('recruiter/dashboard/vacancies/create') }}">Publicar Vacante</a>
						</li>

						<li>
							<a href="{{ url('recruiter/dashboard/candidates/search') }}">Buscar Candidatos</a>
						</li>

						<li>
							<a href="{{ url('recruiter/dashboard/candidates/saved') }}">Candidatos guardados</a>
						</li>

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
					<!-- Trigger -->
					<div class="header-notifications-trigger">
						<a href="#"><i class="icon-feather-bell"></i><span>0</span></a>
					</div>

					<!-- Dropdown -->
					<div class="header-notifications-dropdown">
						<div class="header-notifications-headline">
							<h4>Notifications</h4>
							<button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
								<i class="icon-feather-check-square"></i>
							</button>
						</div>

						{{-- notifications body --}}
						<div class="header-notifications-content">
							<div class="header-notifications-scroll" data-simplebar>
								<ul>
									<!-- Notification -->
									<li class="notifications-not-read">
										<a href="dashboard-manage-candidates.html">
											<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
											<span class="notification-text">
												<strong>Michael Shannah</strong> applied for a job <span class="color">Full Stack Software Engineer</span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>