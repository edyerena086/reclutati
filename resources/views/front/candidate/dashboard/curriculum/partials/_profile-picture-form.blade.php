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
		