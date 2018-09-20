		<div class="col-xl-12">
			<div class="dashboard-box">
				{{-- form title --}}
				<div class="headline">
					<h3><i class="icon-material-outline-add-location"></i> Información de dirección</h3>
				</div>

				{{-- body --}}
				<div class="content">
					<ul class="fields-ul">
						<li>
							
						@if (Auth::user()->candidate->address != null)
							<form action="{{ url('candidate/dashboard/curriculum/addresses/'.Auth::user()->candidate->address->id) }}" method="POST">
								@method('PUT')
						@else
							<form action="{{ url('candidate/dashboard/curriculum/addresses') }}" method="POST">
						@endif
								<div class="row">
									<div class="col">
										<div class="row">
											<div class="col-xl-6">
												<div class="submit-field">
													<h5>*Calle:</h5>
													<input type="text" class="with-border" name="calle" value="{{ (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->street : '' }}">
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>*No. ext:</h5>
													<input type="text" class="with-border" name="numeroExterior" value="{{ (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->external_number : '' }}">
												</div>
											</div>

											<div class="col-xl-3">
												<div class="submit-field">
													<h5>No. int:</h5>
													<input type="text" class="with-border" name="numeroInterior" value="{{ (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->internal_number : '' }}">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Colonia:</h5>
													<input type="text" class="with-border" name="colonia" value="{{ (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->colony : '' }}">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Ciudad/Municipio:</h5>
													<input type="text" class="with-border" name="ciudad" value="{{ (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->city : '' }}">
												</div>
											</div>

											<div class="col-xl-4">
												<div class="submit-field">
													<h5>*Estado:</h5>
													{{ Form::select('estado', \ReclutaTI\State::list(), (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->state_id : null, ['class' => 'with-border selectpicker', 'data-size' => '7', 'title' => 'Selecciona']) }}
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-xl-3">
												<div class="submit-field">
													<h5>*Código postal:</h5>
													<input type="text" class="with-border" name="codigoPostal" value="{{ (Auth::user()->candidate->address != null) ? Auth::user()->candidate->address->zipcode : '' }}">
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