<div class="dashboard-sidebar">
	<div class="dashboard-sidebar-inner" data-simplebar>
		<div class="dashboard-nav-container">
			<!-- Responsive Navigation Trigger -->
			<a href="#" class="dashboard-responsive-nav-trigger">
				<span class="hamburger hamburger--collapse" >
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</span>
				<span class="trigger-title">Dashboard Navigation</span>
			</a>

			<!-- Navigation -->
			<div class="dashboard-nav">
				<div class="dashboard-nav-inner">
					<ul data-submenu-title="Inicio">
						<li><a href="{{ url('candidate/dashboard') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
						<li><a href="{{ url('candidate/dashboard/curriculum') }}"><i class="icon-material-outline-assignment"></i> Mi Curriculum</a></li>
						<li><a href="{{ url('candidate/dashboard/vacancies/favourites') }}"><i class="icon-material-outline-library-books"></i> Vacantes en favoritos</a></li>
						{{--<li>
							<a href=""><i class="icon-material-outline-library-books"></i> Vacantes</a>

							<ul class="dropdown-nav">
								<li>
									<li><a href="{{ url('candidate/dashboard/vacancies/favourites') }}">Vacantes en favoritos</a></li>

									<li><a href="{{ url('candidate/dashboard/vacancies/applied') }}">Vacantes aplicadas</a></li>
								</li>
							</ul>
						</li>--}}
						<li><a href="{{ url('candidate/dashboard/vacancies/applied') }}"><i class="icon-material-outline-check"></i> Mi Postulaciones</a></li>
						{{--<li><a href="{{ url('candidate/dashboard/messages') }}"><i class="icon-material-outline-question-answer"></i> Mensajes <span class="nav-tag">{{ \ReclutaTI\Message::where('addressee', Auth::user()->id)->where('status', 0)->count() }}</span></a></li>--}}
					</ul>

					<ul data-submenu-title="Mi Cuenta">
						<li><a href="{{ url('candidate/dashboard/settings') }}"><i class="icon-material-outline-settings"></i> Configuración</a></li>
						<li><a href="{{ url('candidate/account/logout') }}"><i class="icon-material-outline-power-settings-new"></i> Cerrar sesión</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>