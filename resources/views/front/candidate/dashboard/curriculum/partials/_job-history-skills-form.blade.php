		{{-- job histories --}}
		<div class="col-xl-7">
			<div class="dashboard-box main-box-in-row">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-material-outline-business"></i> Experiencia Laboral</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list job-list">
						<li class="job-li">
							<div class="buttons-to-right always-visible">
								<a href="#small-dialog-3" data-url="{{ url('candidate/dashboard/curriculum/job-histories') }}" data-type="store" class="button popup-with-zoom-anim btn-job-history ripple-effect"><i class="icon-feather-plus-circle"></i> Agregar historial laboral</a>
							</div>
						</li>

						@foreach(Auth::user()->candidate->jobHistories->all() as $job)
							<li class="job-li">
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title job-list-item-title">{{ $job->job_title }}</h3>

											<div class="job-listing-footer">
												<ul>
													<li class="job-list-item-company"><i class="icon-material-outline-business"></i> {{ ucwords($job->company_name) }}</li>
													<li class="job-list-item-duration"><i class="icon-feather-clock"></i> {{ $job->duration }} años</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right">
									<a href="#small-dialog-3" data-type="update" class="button btn-job-history popup-with-zoom-anim dark ripple-effect ico" data-id="{{ $job->id }}" data-company="{{ ucwords($job->company_name) }}" data-job-title="{{ $job->job_title }}" data-duration="{{ $job->duration }}" data-current="{{ $job->current }}" data-url="{{ url('candidate/dashboard/curriculum/job-histories') }}" title="Editar" data-tippy-placement="top" data-description="{{ $job->description }}"><i class="icon-line-awesome-pencil"></i></a>

									<a href="{{ url('candidate/dashboard/curriculum/job-histories/'.$job->id) }}" class="button btn-job-historie-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

		{{-- Skills --}}
		<div class="col-xl-5">
			<div class="dashboard-box child-box-in-row">
				{{--headline --}}
				<div class="headline">
					<h3><i class="icon-feather-globe"></i> Hábilidades</h3>
				</div>

				<div class="content">
					<ul class="dashboard-box-list skill-list">
						<li>
							<div class="buttons-to-right always-visible">
								<a href="#small-dialog-4" data-url="{{ url('candidate/dashboard/curriculum/skills') }}" data-type="store" class="button popup-with-zoom-anim btn-skill ripple-effect"><i class="icon-feather-plus-circle"></i> Agregar hábilidad</a>
							</div>
						</li>

						@foreach(Auth::user()->candidate->skills->all() as $skill)
							<li>
								<div class="job-listing">
									<div class="job-listing-details">
										<div class="job-listing-description">
											<h3 class="job-listing-title skill-title-item">{{ $skill->skill }}</h3>
										</div>
									</div>
								</div>

								{{-- buttons --}}
								<div class="buttons-to-right">
									<a href="#small-dialog-4" data-type="update" class="button btn-skill btn-skill-edit popup-with-zoom-anim dark ripple-effect ico" data-url="{{ url('candidate/dashboard/curriculum/skills') }}" data-id="{{ $skill->id }}" data-skill="{{ $skill->skill }}" data-level="{{ $skill->skill_level_id }}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

									<a href="{{ url('candidate/dashboard/curriculum/skills/'.$skill->id) }}" class="button btn-skill-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

		{{-- job popup form --}}
		<div id="small-dialog-3" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
			{{-- tabs --}}
			<div class="sign-in-form">
				<ul class="popup-tabs-nav">
				</ul>

				{{-- tab content --}}
				<div class="popup-tab-content" id="tab2">
					<div class="welcome-text">
						<h3 class="job-title-modal">Nuevo historial</h3>
						<span>Los campos marcados con (*) son obligatorios.</span>
					</div>

					{{-- form --}}
					<form id="frmJobHistory" class="not-index" data-action="store" method="post" action="{{ url('candidate/dashboard/curriculum/job-histories') }}">
						<div class="row">
							<div class="col-xl-12">
								<strong>*Empresa:</strong>
								<input type="text" placeholder="" name="empresa" class="with-border">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>*Puesto:</strong>
								<input type="text" placeholder="" name="puesto" class="with-border">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>*Duración:</strong><i class="help-icon" data-tippy-placement="right" data-tippy="" data-original-title="Duració en años"></i>
								<input type="text" placeholder="En años" name="duracion" class="with-border">
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<strong>*Descripción:</strong>
								<textarea class="with-border" placeholder="Descripción" name="descripcion" cols="7"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<div class="checkbox">
									<input type="checkbox" name="trabajoActual" id="trabajoActual">
									<label for="trabajoActual"><span class="checkbox-icon"></span> Trabajo actual</label>
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

		{{-- skills popup form --}}
		<div id="small-dialog-4" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
			{{-- tabs --}}
			<div class="sign-in-form">
				<ul class="popup-tabs-nav">
				</ul>

				{{-- tab content --}}
				<div class="popup-tab-content" id="tab2">
					<div class="welcome-text">
						<h3 class="skill-title">Nueva hábilidad</h3>
						<span>Todos los campos son obligatorios.</span>
					</div>

					{{-- form --}}
					<form id="frmSkill" class="not-index" data-action="store" method="post" action="{{ url('candidate/dashboard/curriculum/skills') }}">
						<div class="row">
							<div class="col-xl-6">
								<strong>Hábilidad:</strong>
								<input type="text" placeholder="Ej. Servidores Linux" name="habilidad" class="with-border">
							</div>

							<div class="col-xl-6">
								<strong>Nivel:</strong>
								{{ Form::select('nivel', \ReclutaTI\SkillLevel::list(), null, ['class' => 'with-border', 'data-size' => '7', 'placeholder' => 'Selecciona', 'style' => 'height: 54px;']) }}
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
