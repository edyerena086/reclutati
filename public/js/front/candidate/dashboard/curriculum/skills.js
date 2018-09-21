var btnskills;

$(document).ready(function () {
	//Delete
	$(this).on('click', '.btn-skill-delete', function (e) {
		e.preventDefault();

		var env = this;

		$.confirm({
			title: 'Confirmación',
			content: '¿Deseas eliminar la hábilidad?',
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
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							beforeSend: function () {
								blockForm();
							}, 
							error: function (jqXHR, textStatus, errorThrown) {

								$.jnoty("No se ha podido eliminar la hábilidad.", {
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

									var position = $('.btn-skill-delete').index(env) + 1;

									$('.skill-list li:eq('+position+')').remove();
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


	$(this).on('click', '.btn-skill', function (e) {
		e.preventDefault();

		$('#frmSkill input').removeClass('invalid');
		$('#frmSkill select').removeClass('invalid');
		$('#frmSkill .display-errors').addClass('hidden');

		var actionType = $(this).attr('data-type');

		var route = (actionType == 'store') ? $(this).attr('data-url') : $(this).attr('data-url') + '/' + $(this).attr('data-id');
		$('#frmSkill').attr('action', route);

		if (actionType == 'update'){
			$('#frmSkill input').val($(this).attr('data-skill'));
			$('#frmSkill select').val($(this).attr('data-level'));
			$('#frmSkill').attr('data-action', 'update');
			$('.skill-title').html('Editar hábilidad');
			btnskills = this;
		} else {
			$('#frmSkill input').val('');
			$('#frmSkill select').val('');
			$('#frmSkill').attr('data-action', 'store');
			$('.skill-title').html('Nueva hábilidad');
		}
	});

	//Form
	$('#frmSkill').on('submit', function (e) {
		e.preventDefault();

		var route = $(this).attr('action');
		var env = this;
		var method = $(this).attr('method');
		var dataAction = $(this).attr('data-action');


		//Data
		var data = new FormData();
		$('input, select, textarea', env).each(function () {
			var temporalValue = $(this).val();

			if ($.trim(temporalValue) != '') {
				data.append($(this).attr('name'), $(this).val());
			}
		});

		if (dataAction == 'update') {
			data.append('_method', 'PUT');
		}

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

				$('input, select', env).removeClass('invalid');
				$('.display-errors', env).addClass('hidden');
				$('.display-errors ul', env).empty();
			}, 
			error: function (jqXHR, textStatus, errorThrown) {
				$('button.button-sliding-icon', env).html('Guardar');

				if (jqXHR.status == 422 ){
					$.each(jqXHR.responseJSON.errors, function (key, value) {
						$('input[name=' + key +']', env).addClass('invalid');
						$('select[name=' + key +']', env).addClass('invalid');
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
						$(btnskills).attr('data-skill', $('input', env).val());
						$(btnskills).attr('data-level', $('select', env).val());
						var skillTitlePosition = $('.btn-skill-edit').index(btnskills);
						$('.skill-title-item:eq('+skillTitlePosition+')').html($('input', env).val());
					} else {
						$(env).trigger('reset');

						var element = `<li>
											<div class="job-listing">
												<div class="job-listing-details">
													<div class="job-listing-description">
														<h3 class="job-listing-title skill-title-item">${response.skill}</h3>
													</div>
												</div>
											</div>

											<div class="buttons-to-right">
												<a href="#small-dialog-4" data-type="update" class="button btn-skill btn-skill-edit popup-with-zoom-anim dark ripple-effect ico" data-url="${response.callback_url}" data-id="${response.id}" data-skill="${response.skill}" data-level="${response.skill_level_id}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

												<a href="${response.callback_url}/${response.id}" class="button btn-skill-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
											</div>
										</li>`;

						$('.skill-list').append(element);

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