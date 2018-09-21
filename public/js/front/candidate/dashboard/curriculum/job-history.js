var btnjob;

$(document).ready(function () {
	//Delete education item
	$(this).on('click', '.btn-job-historie-delete', function (e) {
		e.preventDefault();

		var env = this;

		var position = $('.btn-job-historie-delete').index(env) + 1;

		$.confirm({
			title: 'Confirmación',
			content: '¿Deseas eliminar el historial laboral?',
			theme: 'material',
			buttons: {
		        confirmar: {
		        	text: 'Confirmar',
		            btnClass: 'btn-blue',
		            action: function(){
		            	$.ajax({
							type: 'DELETE',
							url: $(env).attr('href'),
							dataType: 'json',
							beforeSend: function () {
								blockForm();
							}, 
							error: function (jqXHR, textStatus, errorThrown) {

								$.jnoty("No se ha podido eliminar el historial laboral.", {
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

									var position = $('.btn-job-historie-delete').index(env) + 1;

									$('.job-list li.job-li:eq('+position+')').remove();
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

	//Education click button add or edit
	$(this).on('click', '.btn-job-history', function (e) {
		e.preventDefault();

		var actionType = $(this).attr('data-type');

		$('#frmJobHistory').trigger('reset');
		$('#frmJobHistory input').removeClass('invalid');
		$('#frmJobHistory textarea').removeClass('invalid');
		$('#frmJobHistory .display-errors').addClass('hidden');

		var route = (actionType == 'store') ? $(this).attr('data-url') : $(this).attr('data-url') + '/' + $(this).attr('data-id');
		$('#frmJobHistory').attr('action', route);

		if (actionType == 'update'){
			$('#frmJobHistory input[name=tituloObtenido]').val($(this).attr('data-title'));
			$('#frmJobHistory input[name=institucionEducativa]').val($(this).attr('data-school'));
			$('#frmJobHistory textarea').val($(this).attr('data-description'));
			$('#frmJobHistory select').val($(this).attr('data-level'));
			if ($(this).attr('data-current') == 1) {
				$('#frmJobHistory input[name=trabajoActual]').prop('checked', true);
			}
			$('#frmJobHistory').attr('data-action', 'update');
			$('.job-title').html('Editar historial');
			btnjob = this;
		} else {
			$('#frmJobHistory input[name=tituloObtenido]').val('');
			$('#frmJobHistory input[name=institucionEducativa]').val('');
			$('#frmJobHistory textarea').val('');
			$('#frmJobHistory select').val('');
			$('#frmJobHistory').attr('data-action', 'store');
			$('.job-title').html('Nuevo historial');
			$('#frmJobHistory input[name=trabajoActual]').prop('checked', false);
		}
	});

	//Form Job History
	$('#frmJobHistory').on('submit', function (e) {
		e.preventDefault();

		var route = $(this).attr('action');
		var env = this;
		var method = $(this).attr('method');
		var dataAction = $(this).attr('data-action');




		//Data
		var data = new FormData();
		$('input, textarea', env).not($('input[type=checkbox]', env)).each(function () {
			var temporalValue = $(this).val();

			if ($.trim(temporalValue) != '') {
				data.append($(this).attr('name'), $(this).val());
			}
		});

		if (dataAction == 'update') {
			data.append('jobHistoryId', route.split('/').pop());
		}

		var trabajoActual = ($('input[type=checkbox]', env).is(':checked')) ? 2 : 1;

		data.append('trabajoActual', trabajoActual);

		$.ajax({
			type: method,
			url: route,
			data: data,
			processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			dataType: 'json',
			beforeSend: function () {
				$('button.button-sliding-icon', env).html("Cargando...");
				blockForm();

				$('input, textarea', env).removeClass('invalid');
				$('.display-errors', env).addClass('hidden');
				$('.display-errors ul', env).empty();
			}, 
			error: function (jqXHR, textStatus, errorThrown) {
				$('button.button-sliding-icon', env).html('Guardar');

				if (jqXHR.status == 422 ){
					$.each(jqXHR.responseJSON.errors, function (key, value) {
						$('input[name=' + key +']', env).addClass('invalid');
						$('textarea[name=' + key +']', env).addClass('invalid');
						$('.display-errors ul', env).append('<li>' + value + '</li>');
					});

					$('.display-errors', env).removeClass('hidden');

					$.jnoty("Haz cometido algunos errores en el formulario.", {
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
				$('button.button-sliding-icon', env).html('Guardar');

				if (response.errors == false) {
					$.jnoty(response.message, {
						header: 'Éxito',
                        theme: 'jnoty-success',
                        life: 5000,
                        position: 'top-right',
                        icon: 'fa fa-check-circle'
					});

					if (dataAction == 'update') {
						$(btnjob).attr('data-school', response.school_name);
						$(btnjob).attr('data-level', response.job_level_id);
						$(btnjob).attr('data-id', response.id);
						$(btnjob).attr('data-title', response.degree);
						$(btnjob).attr('data-description', response.description);
						$(btnjob).attr('data-current', response.current);
						$(btnjob).attr('data-url', response.callback_url);

						var position = $('.btn-education').index(btnjob) - 1;
						$('.job-list-item-title:eq('+position+')').html(response.degree);
						$('.job-list-item-school:eq('+position+')').html('<i class="icon-material-outline-business"></i> ' + response.school_name);
						$('.job-list-item-level:eq('+position+')').html('<i class="icon-material-outline-business-center"></i> ' + $('select option:selected', env).text());

					} else {
						$(env).trigger('reset');

						var element = `<li class="job-li">
											<div class="job-listing">
												<div class="job-listing-details">
													<div class="job-listing-description">
														<h3 class="job-listing-title job-list-item-title">${response.degree}</h3>

														<div class="job-listing-footer">
															<ul>
																<li class="job-list-item-school"><i class="icon-material-outline-business"></i> ${response.school_name}</li>
																<li class="job-list-item-level"><i class="icon-material-outline-business-center"></i> ${response.job_level_name}</li>
															</ul>
														</div>
													</div>
												</div>
											</div>

											
											<div class="buttons-to-right">
												<a href="#small-dialog-1" data-type="update" class="button btn-education popup-with-zoom-anim dark ripple-effect ico" data-school="${response.school_name}" data-level="${response.job_level_id}" data-id="${response.id}" data-title="${response.degree}" data-description="${response.description}" data-current="${response.current}" data-url="${response.callback_url}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

												<a href="${response.callback_url}/${response.id}" class="button btn-job-historie-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
											</div>
										</li>`;

						$('.job-list').append(element);

						initMagnificPopup();
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
	});
});