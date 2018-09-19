var btnLanguages;

$(document).ready(function () {
	//Delete
	$(this).on('click', '.btn-education-delete', function (e) {
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


	$(this).on('click', '.btn-education', function (e) {
		e.preventDefault();

		var actionType = $(this).attr('data-type');

		var route = (actionType == 'store') ? $(this).attr('data-url') : $(this).attr('data-url') + '/' + $(this).attr('data-id');
		$('#frmEducation').attr('action', route);

		if (actionType == 'update'){
			$('#frmEducation input[name=tituloObtenido]').val($(this).attr('data-title'));
			$('#frmEducation input[name=institucionEducativa]').val($(this).attr('data-school'));
			$('#frmEducation textarea').val($(this).attr('data-description'));
			$('#frmEducation select').val($(this).attr('data-level'));
			if ($(this).attr('data-current') == 1) {
				$('#frmEducation input[name=estudiandoActualmente]').prop('checked', true);
			}
			$('#frmEducation').attr('data-action', 'update');
			$('.educative-title').html('Editar historial');
			btnLanguages = this;
		} else {
			$('#frmEducation input[name=tituloObtenido]').val('');
			$('#frmEducation input[name=institucionEducativa]').val('');
			$('#frmEducation textarea').val('');
			$('#frmEducation select').val('');
			$('#frmEducation').attr('data-action', 'store');
			$('.educative-title').html('Nuevo historial');
			$('#frmEducation input[name=estudiandoActualmente]').prop('checked', false);
		}
	});

	//Form
	$('#frmEducation').on('submit', function (e) {
		e.preventDefault();

		var route = $(this).attr('action');
		var env = this;
		var method = $(this).attr('method');
		var dataAction = $(this).attr('data-action');


		//Data
		var data = new FormData();
		$('input, select, textarea', env).not($('input[type=checkbox]', env)).each(function () {
			var temporalValue = $(this).val();

			if ($.trim(temporalValue) != '') {
				data.append($(this).attr('name'), $(this).val());
			}
		});

		var estudiandoActualmente = ($('input[type=checkbox]', env).is(':checked')) ? 2 : 1;

		data.append('estudiandoActualmente', estudiandoActualmente);

		console.log(estudiandoActualmente);

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
					} else {
						/*var element = `<li>
											<div class="job-listing">
												<div class="job-listing-details">
													<div class="job-listing-description">
														<h3 class="job-listing-title">${response.language_name}</h3>
													</div>
												</div>
											</div>

											<div class="buttons-to-right">
												<a href="#small-dialog-2" data-type="update" class="button btn-language popup-with-zoom-anim dark ripple-effect ico" data-url="${response.url}" data-id="${response.id}" data-language="${response.language_id}" data-percent="${response.percent}" title="Editar" data-tippy-placement="top"><i class="icon-line-awesome-pencil"></i></a>

												<a href="${response.url}/${response.id}" class="button btn-language-delete red ripple-effect ico" title="Eliminar" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
											</div>
										</li>`;

						$('.language-list').append(element);*/

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

function initMagnificPopup()
{
	$('.popup-with-zoom-anim').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in'
	});
}