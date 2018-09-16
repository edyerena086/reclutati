		<div class="col-xl-12">
			<div class="dashboard-box">
				{{-- form title --}}
				<div class="headline">
					<h3><i class="icon-material-outline-face"></i> Información de contacto</h3>
				</div>

				{{-- body --}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							<form action="{{ url('candidate/dashboard/curriculum/phones') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-6">
												<div class="submit-field">
													<h5>*Celular:</h5>
													<input type="text" class="with-border" name="celular" value="{{ Auth::user()->candidate->cellphone }}">
												</div>
											</div>

											<div class="col-xl-6">
												<div class="submit-field">
													<h5>Teléfono fijo:</h5>
													<input type="text" class="with-border" name="telefonoFijo" value="{{ Auth::user()->candidate->phone }}">
												</div>
											</div>
										</div>

										{{-- display errors --}}
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

						<li>
							<form action="{{ url('candidate/dashboard/curriculum/social-media') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-3">
												<div class="submit-field">
													<h5>Website:</h5>
													<input type="text" class="with-border" name="website" placeholder="http://www.reclutati.com" value="{{ Auth::user()->candidate->website }}">
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>Facebook:</h5>
													<input type="text" class="with-border" name="facebook" value="{{ Auth::user()->candidate->facebook }}">
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>Twitter:</h5>
													<input type="text" class="with-border" name="twitter" value="{{ Auth::user()->candidate->twitter }}">
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>LinkedIn:</h5>
													<input type="text" class="with-border" name="linkedIn" value="{{ Auth::user()->candidate->linked }}">
												</div>
											</div>
										</div>

										{{-- display errors --}}
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