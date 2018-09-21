$(document).ready(function () {
	$('#profilePicture').change(function() {

		if ($(this).val() != '') {
			console.log('ha cambiado');

			var env = this;
			var standarProfilePicture = $('.profile-pic').attr('src');

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

					var ajaxLoader = $('meta[name="base-url"]').attr('content') + '/images/ajax-loader.gif';

					$('.profile-pic').attr('src', ajaxLoader);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('.profile-pic').attr('src', standarProfilePicture);

					if (jqXHR.status == 422 ){
						var message;

						$.each(jqXHR.responseJSON.errors, function (key, value) {
							message = value[0];
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
				},
				success: function (response) { 
					unblockForm();

					if (!response.errors) {
						$('.profile-pic').attr('src', response.image_url);

						$.jnoty(response.message, {
							header: 'Éxito',
				            theme: 'jnoty-success',
				            life: 5000,
				            position: 'top-right',
				            icon: 'fa fa-check-circle'
						});
					} else {
						$('.profile-pic').attr('src', standarProfilePicture);

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
		} 
	});
});