		<div class="col-xl-3">
			<div class="dashboard-box margin-top-0">
				<div class="headline">
					<h3><i class="icon-material-outline-photo-size-select-actual"></i> Imagen de Perfil</h3>
				</div>

				{{-- body --}}
				<div class="content with-padding padding-bottom-0">
					<div class="row">
						<div class="col-auto">
							<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
								<img class="profile-pic" src="{{  asset('hireo') }}/images/user-avatar-placeholder.png" alt="" />
								<div class="upload-button"></div>
								<input class="file-upload" data-url="{{ url('candidate/dashboard/curriculum/profile-picture') }}" type="file" id="profilePicture" accept="image/*"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		