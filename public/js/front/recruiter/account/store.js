$(document).ready(function () {
	//Form
	$('#frmStore').on('submit', function (e) {
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

					$('.notification').removeClass('hidden');
				}

				$('button', env).html('Crear cuenta');

				//QUEDA PENDIENTE QUE PASA SI HAY UN ERROR DIFERENTE A 422
			},
			success: function (response) {
				$('button', env).html('Crear cuenta');

				if (response.errors == false) {
					window.location = response.callback_url;
				} else {
					unblockForm();

					$('ul', env).append('<li>' + response.message + '</li>');
					$('.notification').removeClass('hidden');
				}
			}
		});
	});
});