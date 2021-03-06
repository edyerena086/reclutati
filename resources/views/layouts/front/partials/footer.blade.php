<footer id="footer">
	{{-- top --}}
	<div class="footer-top-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="footer-rows-container">
						{{--left side--}}
						<div class="footer-rows-left">
							<div class="footer-row">
								<div class="footer-row-inner footer-logo">
									<img src="{{ asset('hireo/images/logo2.png') }}" alt="ReclutaTI - bolsa de trabajo para profesionales de TI">
								</div>
							</div>
						</div>
						
						{{-- right side --}}
						<div class="footer-rows-right">
							{{-- social icons --}}
							<div class="footer-row">
								<div class="footer-row-inner">
									<ul class="footer-social-links">
										<li>
											<a href="https://www.facebook.com/reclutaTImx" target="_blank" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-facebook-f"></i>
											</a>
										</li>

										<li>
											<a href="https://twitter.com/reclutaTImx" target="_blank" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-twitter"></i>
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
	</div>

	{{-- middle --}}
	<div class="footer-middle-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Candidatos</h3>

						<ul>
							<li>
								<a href="{{ url('candidate/account') }}">Crear mi cuenta</a>
							</li>

							<li>
								<a href="{{ url('candidate') }}">Iniciar sesión</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Reclutadores</h3>

						<ul>
							<li>
								<a href="{{ url('recruiter/account') }}">Crear mi cuenta</a>
							</li>

							<li>
								<a href="{{ url('recruiter') }}">Iniciar sesión</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Vacantes</h3>

						<ul>
							<li>
								<a href="{{ url('buscar/vacante') }}">Buscar vacante</a>
							</li>

							<li>
								<a href="{{ url('vacantes/estado') }}">Por estado</a>
							</li>

							{{--<li>
								<a href="{{ url('vacantes/empresa') }}">Por empresa</a>
							</li>--}}
						</ul>
					</div>
				</div>

				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Legales</h3>

						<ul>
							<li>
								<a href="{{ url('aviso-de-privacidad') }}">Aviso de Privacidad</a>
							</li>

							<li>
								<a href="{{ url('terminos-y-condiciones') }}">Términos y Condiciones de uso</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- bottom --}}
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					© {{ \Carbon\Carbon::now()->year }} <strong>ReclutaTI</strong>. Todos los derechos reservados. Powered by <a href="http://uitastudio.com" target="_blank" style="color: #fff">UitaStudio</a>
				</div>
			</div>
		</div>
	</div>
</footer>