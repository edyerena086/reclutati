$(document).ready(function () {
	$(this).on('change', '.cvUpload', function() {

		if ($(this).val() != '') {

			var env = this;

			var data = new FormData();
			data.append('resume', $(env)[0].files[0]);

			$.ajax({
				type: 'POST',
				url: $(env).attr('data-url'),
				data: data,
				cache:false,
	            contentType: false,
	            processData: false,
	            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	            dataType: 'json',
	            beforeSend: function () {
					blockForm();

					$('#cvUploadInfo').html('Cargando...');
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#cvUploadInfo').html('Peso máximo: 2 MB');

					if (jqXHR.status == 422 ){
						var message;

						$.each(jqXHR.responseJSON.errors, function (key, value) {
							message = value[0];
						});

						$.jnoty(message, {
							header: 'Advertencia',
	                        theme: 'jnoty-danger',
	                        life: 5000,
	                        color: 'rti-danger',
	                        position: 'top-right',
	                        icon: 'fa fa-info-circle'
						});
					}

					unblockForm();
				},
				success: function (response) { 
					unblockForm();

					if (!response.errors) {
						$('#cvUploadInfo').html('Peso máximo: 2 MB');

						$.jnoty(response.message, {
							header: 'Éxito',
				            theme: 'jnoty-success',
				            life: 5000,
				            position: 'top-right',
				            icon: 'fa fa-check-circle'
						});

						//Add new record to table
						var baseRoute = $('meta[name=base-url]').attr('content');
						$('#noResumeUploaded').remove();
						var newRecord = `<tr>
												<td>
													<i class="icon-material-outline-picture-as-pdf"></i> <a href="${response.file_url}" target="_blank">${response.file_name}</a>
												</td>
												<td>
													<a href="${baseRoute}/candidate/dashboard/curriculum/delete-resume/${response.file_id}" data-resume="${response.file_name}" class="button ripple-effect btnDeleteResume">Borrar <i class="icon-material-outline-delete"></i></a>
												</td>
											</tr>`;
						$('#resumeTable tbody').append(newRecord);

						//Delete upload button
						if (response.delete_upload_button == true) {
							$('#printUploadCV').html('');
						}
					} else {
						$('#cvUploadInfo').html('Peso máximo: 2 MB');

						$.jnoty(response.message, {
							header: 'Advertencia',
	                        theme: 'jnoty-danger',
	                        life: 5000,
	                        color: 'rti-danger',
	                        position: 'top-right',
	                        icon: 'fa fa-info-circle'
						});
					}
				}
			});
		}
	});

	//Delete resume
	$(this).on('click', '.btnDeleteResume', function (e) {
		e.preventDefault();

		var env = this;

		$.confirm({
			title: 'Confirmación',
			content: '¿Deseas eliminar el archivo ' + $(env).attr('data-resume') + '?',
			theme: 'material',
			buttons: {
		        confirmar: {
		        	text: 'Confirmar',
		            btnClass: 'btn-blue',
		            action: function(){
		            	$.ajax({
							type: 'GET',
							url: $(env).attr('href'),
							dataType: 'json',
							beforeSend: function () {
								blockForm();
							}, 
							error: function (jqXHR, textStatus, errorThrown) {

								$.jnoty("No se ha podido eliminar el archivo.", {
									header: 'Advertencia',
				                    theme: 'jnoty-danger',
				                    life: 5000,
				                    color: 'rti-danger',
				                    position: 'top-right',
				                    icon: 'fa fa-info-circle'
								});

								unblockForm();
							},
							success: function (response) {
								if (response.errors == false) {
									$.jnoty(response.message, {
										header: 'Éxito',
				                        theme: 'jnoty-success',
				                        life: 5000,
				                        position: 'top-right',
				                        icon: 'fa fa-check-circle'
									});

									var position = $('.btnDeleteResume').index(env) + 1;

									$('#resumeTable tr:eq('+position+')').remove();

									var innerRoute = $('meta[name=base-url]').attr('content');

									var uploadButton = `<div class="uploadButton margin-top-0" style="padding-top: 1rem;">
															<input class="uploadButton-input cvUpload" data-url="${innerRoute}/candidate/dashboard/curriculum/upload-resume" type="file" accept="image/*, application/pdf" id="upload"/>
															<label class="uploadButton-button ripple-effect" for="upload">Carga tu CV</label>
															<span class="uploadButton-file-name">Peso máximo: 2 MB</span>
														</div>`;

									$('#printUploadCV').html(uploadButton);

									if (response.file_count == 0) {
										$('#resumeTable tbody').append(`<tr id="noResumeUploaded">
														<td colspan="2" align="center">No hay archivos que mostrar</td>
													</tr>`);
									}
								} else {
									$.jnoty(response.message, {
										header: 'Advertencia',
				                        theme: 'jnoty-danger',
				                        life: 5000,
				                        color: 'rti-danger',
				                        position: 'top-right',
				                        icon: 'fa fa-info-circle'
									});
								}

								unblockForm();
							}
						});
		            }
		        },
		        cancelar: function () {
		        }
		    }
		});
	});
});