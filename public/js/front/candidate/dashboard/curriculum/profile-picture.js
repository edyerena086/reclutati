$(document).ready(function () {
	$('#profilePicture').change(function() {

		if ($(this).val() != '') {
			console.log('ha cambiado');

			var env = this;

			var data = new FormData();
			data.append('imagenDePerfil', $(env)[0].files[0]);

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
				},
				error: function (jqXHR, textStatus, errorThrown) {
					if (jqXHR.status == 422 ){
						var message;

						$.each(jqXHR.responseJSON.errors, function (key, value) {
							message = value;
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
				}
			});
		} 
	});
});