		<div class="col-xl-3">
			<div class="dashboard-box margin-top-0">
				<div class="headline">
					<h3><i class="icon-material-outline-photo-size-select-actual"></i> Imagen de Perfil</h3>
				</div>

				{{-- body --}}
				<div class="content with-padding padding-bottom-0">
					<div class="row">
						<div class="col-auto">
							<div class="avatar-wrapper" data-tippy-placement="bottom" title="Cambiar imagen">
								@if (Auth::user()->candidate->profile_picture == '')
									<img class="profile-pic" src="{{  asset('hireo') }}/images/user-avatar-placeholder.png" alt="" />
								@else
									<img class="profile-pic" src="{{  asset('storage/candidates/'.Auth::user()->candidate->id.'/'.\ReclutaTI\Candidate::find(Auth::user()->candidate->id)->profile_picture) }}" alt="" />
								@endif
								<div class="upload-button"></div>
								<input class="file-upload" data-url="{{ url('candidate/dashboard/curriculum/profile-picture') }}" type="file" id="profilePicture" accept="image/*"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Resume FILES --}}
		<div class="col-xl-9">
			<div class="dashboard-box margin-top-0">
				<div class="headline">
					<h3><i class="icon-material-outline-attach-file"></i> Carga tu Curriculum</h3>
				</div>

				{{-- body --}}
				<div class="content with-padding padding-bottom-0">
					<div class="row">
						<div class="col-xl-12">
							<table class="basic-table" id="resumeTable">
								<thead>
									<tr>
										<th width="60%">Archivo</th>
										<th width="40%">Acciones</th>
									</tr>
								</thead>

								<tbody>
									@if(Auth::user()->candidate->files->count() > 0)
										@foreach(Auth::user()->candidate->files as $file)
											<tr>
												<td>
													<i class="icon-material-outline-picture-as-pdf"></i> <a href="{{ url('storage/candidates/'.Auth::user()->candidate->id.'/resumes/'.$file->file) }}" target="_blank">{{ $file->file_public_name }}</a>
												</td>
												<td>
													<a href="{{ url('candidate/dashboard/curriculum/delete-resume/'.$file->id) }}" data-resume="{{ $file->file_public_name }}" class="button ripple-effect btnDeleteResume">Borrar <i class="icon-material-outline-delete"></i></a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="3" align="center">No hay archivos que mostrar</td>
										</tr>
									@endif
								</tbody>
							</table>

							<!-- Upload Button -->
							<div id="printUploadCV">
								@if(Auth::user()->candidate->files->count() < 3)
									<div class="uploadButton margin-top-0" style="padding-top: 1rem;">
										<input class="uploadButton-input cvUpload" data-url="{{ url('candidate/dashboard/curriculum/upload-resume') }}" type="file" accept="image/*, application/pdf" id="upload"/>
										<label class="uploadButton-button ripple-effect" for="upload">Carga tu CV</label>
										<span class="uploadButton-file-name">Peso máximo: 2 MB</span>
									</div>
								@endif	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		