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
						<li><a href="{{ url('recruiter/dashboard') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
						<li><a href="{{ url('recruiter/dashboard/vacancies') }}"><i class="icon-brand-wpforms"></i> Mis Vacantes</a></li>
						<li><a href="dashboard-messages.html"><i class="icon-material-outline-question-answer"></i> Mensajes <span class="nav-tag">0</span></a></li>
					</ul>

					<ul data-submenu-title="Mi Cuenta">
						<li><a href="{{ url('recruiter/account/logout') }}"><i class="icon-material-outline-power-settings-new"></i> Cerrar sesión</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>