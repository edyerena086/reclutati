<header id="header-container" class="fullwidth dashboard-header not-sticky">
	<div id="header">
		<div class="container">
			{{-- Left Side --}}
			<div class="left-side">
				<div id="logo">
					<a href="{{ url('candidate/dashboard') }}"><img src="{{ asset('hireo/images/logo.png') }}" alt=""></a>
				</div>

				{{-- menu nav --}}
				<nav id="navigation">
					<ul id="responsive">
						<li>
							<a href="{{ url('/') }}">Ir al portal</a>
						</li>

						<li>
							<a href="{{ url('buscar/vacante') }}">Buscar empleo</a>
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
						<a href="#"><i class="icon-feather-bell"></i><span>{{ Auth::user()->unreadNotifications->count() }}</span></a>
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

				{{-- User profile --}}
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="{{ asset('hireo/images/user-avatar-small-01.jpg') }}" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="{{ url('hireo/images/user-avatar-small-01.jpg') }}" alt=""></div>
									<div class="user-name">
										{{ ucwords(Auth::user()->name.' '.Auth::user()->candidate->last_name) }} {{--<span>Freelancer</span>--}}
									</div>
								</div>
								
								<!-- User Status Switcher -->
								{{--<div class="status-switch" id="snackbar-user-status">
									<label class="user-online current-status">Online</label>
									<label class="user-invisible">Invisible</label>
									<!-- Status Indicator -->
									<span class="status-indicator" aria-hidden="true"></span>
								</div>--}}
						</div>
						
						<ul class="user-menu-small-nav">
							<li><a href="{{ url('candidate/dashboard') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="{{ url('candidate/dashboard/curriculum') }}"><i class="icon-material-outline-assignment"></i> Mi Curriculum</a></li>
							<li><a href="{{ url('candidate/account/logout') }}"><i class="icon-material-outline-power-settings-new"></i> Cerrar sesión</a></li>
						</ul>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</header>