		<div class="col-xl-7">
			<div class="dashboard-box main-box-in-row">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-account-circle"></i> Educación</h3>
				</div>

				{{--<div class="content with-padding padding-bottom-0">--}}
				<div class="content">
					{{--<ul class="fields-ul">
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
										
										{{+-- last name --+}}
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

										{{*-- age and gender --*}}
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

										{{*-- button --*}}
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

										{{+-- button --+}}
										<div class="col-xl-12">
											<button class="button ripple-effect big">
												Guardar
											</button>
										</div>
									</div>
								</div>
							</form>
						</li>
					</ul>--}}
				</div>
			</div>
		</div>

		{{-- languages --}}
		<div class="col-xl-5">
			<div class="dashboard-box child-box-in-row">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-feather-globe"></i> Idiomas</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list language-list">
						<li>
							<div class="buttons-to-right always-visible">
								<a href="#small-dialog-2" data-url="{{ url('candidate/dashboard/curriculum/languages') }}" data-type="store" class="button popup-with-zoom-anim btn-language ripple-effect"><i class="icon-feather-plus-circle"></i> Agregar idioma</a>
							</div>
						</li>

						@foreach(Auth::user()->candidate->languages->all() as $language)
							<li>
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title">{{ ucwords($language->language->where('id', $language->language_id)->first()->name) }}</h3>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right">
									<a href="#small-dialog-2" data-type="update" class="button btn-language popup-with-zoom-anim dark ripple-effect ico" data-url="{{ url('candidate/dashboard/curriculum/languages') }}" data-id="{{ $language->id }}" data-language="{{ $language->language_id }}" data-percent="{{ $language->percent }}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

									<a href="{{ url('candidate/dashboard/curriculum/languages/'.$language->id) }}" class="button btn-language-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>


		{{-- laguages popup form --}}
		<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
			{{-- tabs --}}
			<div class="sign-in-form">
				<ul class="popup-tabs-nav">
				</ul>

				{{-- tab content --}}
				<div class="popup-tab-content" id="tab2">
					<div class="welcome-text">
						<h3 class="language-title">Nuevo idioma</h3>
						<span>Todos los campos son obligatorios.</span>
					</div>

					{{-- form --}}
					<form id="frmLanguage" data-action="store" method="post" action="{{ url('candidate/dashboard/curriculum/languages') }}">
						<div class="row">
							<div class="col-xl-7">
								<strong>Idioma:</strong>
								{{ Form::select('idioma', \ReclutaTI\Language::list(), null, ['class' => 'with-border', 'data-size' => '7', 'placeholder' => 'Selecciona', 'style' => 'height: 58px;']) }}
							</div>

							<div class="col-xl-5">
								<strong>Procentaje de dominio:</strong>
								<input type="text" placeholder="80" name="porcentaje" class="with-border">
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

						<button class="button full-width button-sliding-icon ripple-effect" type="submit">Guardar<i class="icon-material-outline-arrow-right-alt"></i></button>
					</form>
				</div>
			</div>
		</div>