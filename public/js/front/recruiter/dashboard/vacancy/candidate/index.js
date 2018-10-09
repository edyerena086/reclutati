$(document).ready(function () {
	$(this).on('click', '.remove-candidate', function (e) {
		e.preventDefault();

		var env = this;

		$.confirm({
			title: 'Confirmación',
			content: '¿Deseas remover al candidato de esta vacante?',
			theme: 'material',
			buttons: {
		        confirmar: {
		        	text: 'Confirmar',
		            btnClass: 'btn-blue',
		            action: function(){
		            	$.ajax({
							type: 'POST',
							url: $(env).attr('href'),
							dataType: 'json',
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							beforeSend: function () {
								blockForm();
							}, 
							error: function (jqXHR, textStatus, errorThrown) {

								$.jnoty("No se ha podido eliminar la vacante.", {
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

									var position = $('.remove-candidate').index(env);

									$('li.candidate-item:eq('+position+')').remove();

									$('.candidateCounter').html('<i class="icon-material-outline-supervisor-account"></i> ' + response.candidateCounter);
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

	//Send message button
	$('.btn-send-message').on('click', function(e) {
		e.preventDefault();

		$('#frmMessage').attr('action', $(this).attr('data-url'))
						.trigger('reset');
	});

	//Form message
	$('#frmMessage').on('submit', function (e) {
		e.preventDefault();

		var env = this;

		$.ajax({
			type: $(env).attr('method'),
			url: $(env).attr('action'),
			data: $(env).serialize(),
			dataType: 'json',			
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			beforeSend: function () {
				$('button.button-sliding-icon', env).html("Cargando...");
				blockForm();

				$('input, textarea', env).removeClass('invalid');
				$('.display-errors', env).addClass('hidden');
				$('.display-errors ul', env).empty();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('button.button-sliding-icon', env).html('Enviar');

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
				
				$('button.button-sliding-icon', env).html('Enviar');
				
				if (response.errors == false) {
					$.jnoty(response.message, {
						header: 'Éxito',
                        theme: 'jnoty-success',
                        life: 5000,
                        position: 'top-right',
                        icon: 'fa fa-check-circle'
					});

					$(env).trigger('reset');
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