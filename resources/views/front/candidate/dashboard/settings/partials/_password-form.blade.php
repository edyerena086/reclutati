		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-lock"></i> Seguridad</h3>
				</div>

				{{--<div class="content with-padding padding-bottom-0">--}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							<form action="{{ url('candidate/dashboard/curriculum/general-info') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Contraseña actual:</h5>
													<input type="text" name="primerNombre" class="with-border" value="{{ ucwords(Auth::user()->name) }}">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Nueva contraseña:</h5>
													<input type="text" name="segundoNombre" class="with-border" value="{{ ucwords(Auth::user()->candidate->second_name) }}">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>Confirmación:</h5>
													<input type="text" name="segundoNombre" class="with-border" value="{{ ucwords(Auth::user()->candidate->second_name) }}">
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