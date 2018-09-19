var btnLanguages;

$(document).ready(function () {
	//Delete
	$(this).on('click', '.btn-language-delete', function (e) {
		e.preventDefault();

		var env = this;

		$.confirm({
			title: 'Confirmación',
			content: '¿Deseas eliminar el idioma?',
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

								$.jnoty("No se ha podido eliminar el idioma.", {
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

									var position = $('.btn-language-delete').index(env) + 1;

									$('.language-list li:eq('+position+')').remove();
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


	$(this).on('click', '.btn-language', function (e) {
		e.preventDefault();

		var actionType = $(this).attr('data-type');

		var route = (actionType == 'store') ? $(this).attr('data-url') : $(this).attr('data-url') + '/' + $(this).attr('data-id');
		$('#frmLanguage').attr('action', route);

		if (actionType == 'update'){
			$('#frmLanguage input').val($(this).attr('data-percent'));
			$('#frmLanguage select').val($(this).attr('data-language'))
			$('#frmLanguage').attr('data-action', 'update');
			$('.language-title').html('Editar idioma');
			btnLanguages = this;
		} else {
			$('#frmLanguage input').val('');
			$('#frmLanguage select').val('');
			$('#frmLanguage').attr('data-action', 'store');
			$('.language-title').html('Nuevo idioma');
		}
	});

	//Form
	$('#frmLanguage').on('submit', function (e) {
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

				$('input, select, textarea', env).removeClass('invalid');
				$('.display-errors', env).addClass('hidden');
				$('.display-errors ul', env).empty();
			}, 
			error: function (jqXHR, textStatus, errorThrown) {
				$('button.button-sliding-icon', env).html('Guardar');

				if (jqXHR.status == 422 ){
					$.each(jqXHR.responseJSON.errors, function (key, value) {
						$('input[name=' + key +']', env).addClass('invalid');
						$('select[name=' + key +']', env).addClass('invalid');
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
						$(btnLanguages).attr('data-percent', $('input', env).val());
						$(btnLanguages).attr('data-language', $('select', env).val());
						var languageTitlePosition = $('.btn-language-edit').index(btnLanguages);
						$('.language-title-item:eq('+languageTitlePosition+')').html($('select option:selected', env).text());
					} else {
						$(env).trigger('reset');

						var element = `<li>
											<div class="job-listing">
												<div class="job-listing-details">
													<div class="job-listing-description">
														<h3 class="job-listing-title language-title-item">${response.language_name}</h3>
													</div>
												</div>
											</div>

											<div class="buttons-to-right">
												<a href="#small-dialog-2" data-type="update" class="button btn-language btn-language-edit popup-with-zoom-anim dark ripple-effect ico" data-url="${response.url}" data-id="${response.id}" data-language="${response.language_id}" data-percent="${response.percent}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

												<a href="${response.url}/${response.id}" class="button btn-language-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
											</div>
										</li>`;

						$('.language-list').append(element);

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