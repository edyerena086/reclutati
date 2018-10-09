<header id="header-container" class="fullwidth">
	<!-- Header -->
	<div id="header">
		<div class="container">
			<!-- Left Side Content -->
			<div class="left-side">
				<!-- Logo -->
				<div id="logo">
					<a href="{{ url('/') }}"><img src="{{ asset('hireo/images/logo.png') }}" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">
						<li>
							<a href="{{ url('buscar/vacante') }}">Buscar empleo</a>
						</li>

						<li>
							<a href="{{ url('candidate/dashboard') }}">Dashboard</a>
						</li>

						<li>
							<a href="{{ url('candidate/dashboard/curriculum') }}">Mi Curriculum</a>
						</li>

						<li>
							<a href="{{ url('candidate/dashboard/messages') }}">Mensajes</a>
						</li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>
			</div>
			<!-- Right Side Content / End -->
		</div>
	</div>
	<!-- Header / End -->
</header>
<div class="clearfix"></div>