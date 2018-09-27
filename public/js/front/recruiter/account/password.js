$(document).ready(function () {
	//Form
	$('form').on('submit', function (e) {
		e.preventDefault();

		var env = this;

		$.ajax({
			type: 'post',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			beforeSend: function () {
				blockForm();
				$('input', env).removeClass('invalid');
				$('i', env).removeClass('invalid-icon');

				$('.notification').addClass('hidden');
				$('ul', env).empty();

				$('button', env).html('Cargando...');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				unblockForm();

				if (jqXHR.status == 422 ){
					$.each(jqXHR.responseJSON.errors, function (key, value) {
						$('input[name=' + key +']', env).addClass('invalid');
						$('ul', env).append('<li>' + value + '</li>');
						$('#i-' + key, env).addClass('invalid-icon');
					});

					$.jnoty("Haz cometido algunos errores en el formulario.", {
						header: 'Advertencia',
                        theme: 'jnoty-danger',
                        life: 5000,
                        color: 'rti-danger',
                        position: 'top-right',
                        icon: 'fa fa-info-circle'
					});

					$('.notification').removeClass('hidden');
				}

				$('button', env).html('Enviar');

				//QUEDA PENDIENTE QUE PASA SI HAY UN ERROR DIFERENTE A 422
			},
			success: function (response) {
				$('button', env).html('Enviar');
				
				unblockForm();

				if (response.errors == false) {
					$.jnoty(response.message, {
						header: 'Éxito',
                        theme: 'jnoty-success',
                        life: 5000,
                        position: 'top-right',
                        icon: 'fa fa-check-circle'
					});

					if (response.redirect) {
						setInterval(function () {
							window.location = response.callback_url;
						}, 5000)
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
			}
		});
	});
});