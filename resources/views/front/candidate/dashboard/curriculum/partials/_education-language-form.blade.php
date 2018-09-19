		<div class="col-xl-7">
			<div class="dashboard-box main-box-in-row">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-account-circle"></i> Educación</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list educative-list">
						<li>
							<div class="buttons-to-right always-visible">
								<a href="#small-dialog-1" data-url="{{ url('candidate/dashboard/curriculum/educative-histories') }}" data-type="store" class="button popup-with-zoom-anim btn-education ripple-effect"><i class="icon-feather-plus-circle"></i> Agregar historial educativo</a>
							</div>
						</li>

						@foreach(Auth::user()->candidate->educativeHistories->all() as $educative)
							<li>
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title">{{ $educative->degree }}</h3>

											<div class="job-listing-footer">
												<ul>
													<li><i class="icon-material-outline-business"></i> {{ ucwords($educative->school_name) }}</li>
													<li><i class="icon-material-outline-business-center"></i> {{ ucwords($educative->educativeLevel->where('id', $educative->educative_level_id)->first()->name) }}</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right">
									<a href="#small-dialog-1" data-type="update" class="button btn-education popup-with-zoom-anim dark ripple-effect ico" data-school="{{ ucwords($educative->school_name) }}" data-level="{{ $educative->educative_level_id }}" data-id="{{ $educative->id }}" data-title="{{ $educative->degree }}" data-description="{{ $educative->description }}" data-current="{{ $educative->current }}" data-url="{{ url('candidate/dashboard/curriculum/educative-histories') }}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

									<a href="{{ url('candidate/dashboard/curriculum/languages/'.$educative->id) }}" class="button btn-language-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
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

		{{-- educative popup form --}}
		<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
			{{-- tabs --}}
			<div class="sign-in-form">
				<ul class="popup-tabs-nav">
				</ul>

				{{-- tab content --}}
				<div class="popup-tab-content" id="tab2">
					<div class="welcome-text">
						<h3 class="educative-title">Nuevo historial</h3>
						<span>Los campos marcados con (*) son obligatorios.</span>
					</div>

					{{-- form --}}
					<form id="frmEducation" class="not-index" data-action="store" method="post" action="{{ url('candidate/dashboard/curriculum/educative-histories') }}">
						<div class="row">
							<div class="col-xl-12">
								<strong>*Título obtenido:</strong>
								<input type="text" placeholder="Ej. Ingeniero en Sistemas Computacionales" name="tituloObtenido" class="with-border">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>*Institución educativa:</strong>
								<input type="text" placeholder="Ej. UNAM" name="institucionEducativa" class="with-border">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>*Nivel educativo:</strong>
								{{ Form::select('nivelEducativo', \ReclutaTI\EducativeLevel::list(), null, ['class' => 'with-border', 'data-size' => '7', 'placeholder' => 'Selecciona', 'style' => 'height: 58px;']) }}
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>Descripción:</strong>
								<textarea class="with-border" placeholder="Descripción" name="descripcion" cols="7"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<div class="checkbox">
									<input type="checkbox" name="estudiandoActualmente" id="estudiandoActualmente">
									<label for="estudiandoActualmente"><span class="checkbox-icon"></span> Estudiando actualmente</label>
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

						<button class="button full-width button-sliding-icon ripple-effect" type="submit">Guardar<i class="icon-material-outline-arrow-right-alt"></i></button>
					</form>
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
					<form id="frmLanguage" class="not-index" data-action="store" method="post" action="{{ url('candidate/dashboard/curriculum/languages') }}">
						<div class="row">
							<div class="col-xl-7">
								<strong>Idioma:</strong>
								{{ Form::select('idioma', \ReclutaTI\Language::list(), null, ['class' => 'with-border', 'data-size' => '7', 'placeholder' => 'Selecciona', 'style' => 'height: 58px;']) }}
							</div>

							<div class="col-xl-5">
								<strong>Procentaje de dominio:</strong>
								<input type="text" placeholder="Ej. 80" name="porcentaje" class="with-border">
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