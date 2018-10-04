		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-email"></i> Correo electrónico</h3>
				</div>

				{{--<div class="content with-padding padding-bottom-0">--}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							<form action="{{ url('candidate/dashboard/settings/email') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Correo actual:</h5>
													<input type="email" name="currentEmail" class="with-border" value="">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Nuevo correo:</h5>
													<input type="email" name="newEmail" class="with-border">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Contraseña:</h5>
													<input type="password" name="password" class="with-border">
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