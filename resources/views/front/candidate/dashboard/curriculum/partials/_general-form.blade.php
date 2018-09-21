		<div class="col-xl-12">
			<div class="dashboard-box">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-account-circle"></i> Datos Generales</h3>
				</div>

				{{--<div class="content with-padding padding-bottom-0">--}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							<form action="{{ url('candidate/dashboard/curriculum/general-info') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-6">
												<div class="submit-field">
													<h5>*Primer nombre:</h5>
													<input type="text" name="primerNombre" class="with-border" value="{{ ucwords(Auth::user()->name) }}">
												</div>
											</div>

											<div class="col-xl-6">
												<div class="submit-field">
													<h5>Segundo nombre:</h5>
													<input type="text" name="segundoNombre" class="with-border" value="{{ ucwords(Auth::user()->candidate->second_name) }}">
												</div>
											</div>
										</div>
										
										{{-- last name --}}
										<div class="row">
											<div class="col-xl-6">
												<div class="submit-field">
													<h5>*Apellido paterno:</h5>
													<input type="text" name="apellidoPaterno" class="with-border" value="{{ ucwords(Auth::user()->candidate->last_name) }}">
												</div>
											</div>

											<div class="col-xl-6">
												<div class="submit-field">
													<h5>Apellido materno:</h5>
													<input type="text" name="apellidoMaterno" class="with-border" value="{{ ucwords(Auth::user()->candidate->second_last_name) }}">
												</div>
											</div>
										</div>

										{{-- age and gender --}}
										<div class="row">
											<div class="col-xl-3">
												<div class="submit-field">
													<h5>Edad:</h5>
													<input type="number" min="16" max="85" name="edad" class="with-border" value="{{ Auth::user()->candidate->age }}">
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>Genero:</h5>
													{{ Form::select('genero', \ReclutaTI\Gender::list(), Auth::user()->candidate->gender_id, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>Estado civil:</h5>
													{{ Form::select('estadoCivil', \ReclutaTI\CivilStatus::list(), Auth::user()->candidate->civil_status_id, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
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

						<li>
							<form action="{{ url('candidate/dashboard/curriculum/labor-goal') }}" method="POST">
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-12">
												<div class="submit-field">
													<h5>*Objetivo laboral:</h5>
													<textarea cols="30" rows="5" name="objetivoLaboral" class="with-border">{{ Auth::user()->candidate->labor_goal }}</textarea>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-xl-12">
												<div class="notification error closable hidden display-errors">
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