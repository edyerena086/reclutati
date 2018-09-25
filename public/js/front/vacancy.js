var btnApply = true;

$(document).ready(function () {
	$('.lets-apply').on('click', function (e) {
		e.preventDefault();

			var route = $(this).attr('href');
			var env = this;

			$.ajax({
				type: 'POST',
				url: route,
	            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				dataType: 'json',
				beforeSend: function () {
					$(env).html("Cargando...");
					$(env).unbind('click');
					blockForm();
				}, 
				error: function (jqXHR, textStatus, errorThrown) {
					$(env).html('Aplicar ahora');

					unblockForm();
				},
				success: function (response) {
					$(env).html('Aplicar ahora');

					if (response.errors == false) {
						$.jnoty(response.message, {
							header: 'Éxito',
	                        theme: 'jnoty-success',
	                        life: 5000,
	                        position: 'top-right',
	                        icon: 'fa fa-check-circle'
						});

						$(env).attr('href', '');
						$(env).removeClass('lets-apply');
						$(env).html('¡Gracias por aplicar!');
						$(env).addClass('btn-has-applied');
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