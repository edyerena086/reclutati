$(document).ready(function () {
	$('#description').richText();

	var textareaLength = $('textarea[name=descripcionBreve]').val().length;
	var initialLength = 300 - textareaLength;
	$('#descripcionBreveSpan span').html(initialLength + ' carácteres');

	$('form').on('submit', function (e) {
		e.preventDefault();

		var route = $(this).attr('action');
		var env = this;
		var method = $(this).attr('method');

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
				$('button.big', env).html("Cargando...");
				blockForm();

				$('input, select, textarea', env).removeClass('invalid');
				$('.display-errors', env).addClass('hidden');
				$('.display-errors ul', env).empty();
			}, 
			error: function (jqXHR, textStatus, errorThrown) {
				$('button.big', env).html('Guardar');

				if (jqXHR.status == 422 ){
					$.each(jqXHR.responseJSON.errors, function (key, value) {
						$('input[name=' + key +']', env).addClass('invalid');
						$('select[name=' + key +'].dropdown-toggle', env).addClass('invalid');
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
				$('button.big', env).html('Guardar');

				if (response.errors == false) {
					$.jnoty(response.message, {
						header: 'Éxito',
                        theme: 'jnoty-success',
                        life: 5000,
                        position: 'top-right',
                        icon: 'fa fa-check-circle'
					});

					if (response.create) {
						$(env).trigger('reset');
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

function countChar(val)
{
	var len = $.trim(val.value.length);
	var print = 300 - len;

	$('#descripcionBreveSpan span').html(print + ' carácteres');
}