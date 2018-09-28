		<div class="col-xl-12">
			<div class="dashboard-box">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-lock"></i> Seguridad</h3>

					<p>
						Si deseas cambair tu contraseña por favor completa el siguiente formulario, te enviaremos una notificación a tu correo validando el hecho al términar el proceso.
					</p>
				</div>

				{{--<div class="content with-padding padding-bottom-0">--}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							<form action="{{ url('recruiter/dashboard/settings/password') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Contraseña actual:</h5>
													<input type="password" name="currentPassword" class="with-border" value="">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Nueva contraseña:</h5>
													<input type="password" name="password" class="with-border">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>Confirmación:</h5>
													<input type="password" name="password_confirmation" class="with-border">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-xl-12">
												<div class="notification error hidden closable display-errors">
													<p>
														Se han cometido los siguientes errores:
													</p>

													<ul>
													</ul>
												</div>
											</div>
										</div>

										{{-- button --}}
										<div class="col-xl-12">
											<button class="button ripple-effect big">
												Guardar
											</button>
										</div>
									</div>
								</div>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</div>