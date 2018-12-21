var btnApply = true;

$(document).ready(function () {
	var $share = $('#share');
	$("#share").jsSocials({
		showLabel: false,
		shareIn: "popup",
		url: $share.attr('data-url'),
		text: $share.attr('data-text'),
        shares: ["email", "twitter", "facebook", "googleplus"]
    });

    $('.bookmark-button').on('click', function (e) {
    	e.preventDefault();

    	var route = $(this).attr('data-url');
    	var env = this;

    	$.ajax({
				type: 'GET',
				url: route,
				dataType: 'json',
				beforeSend: function () {
					$('span.bookmark-text', env).html("Cargando...");
					$(env).unbind('click');
					blockForm();
				}, 
				error: function (jqXHR, textStatus, errorThrown) {
					$(env).html('Guardar vacante');

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
						
						$(env).addClass('bookmarked');
					} else {
						$.jnoty(response.message, {
							header: 'Advertencia',
	                        theme: 'jnoty-danger',
	                        life: 5000,
	                        color: 'rti-danger',
	                        position: 'top-right',
	                        icon: 'fa fa-info-circle'
						});

						$(env).html('Guardar vacante');
					}

					unblockForm();
				}
			});
    })

    /**
     * [description]
     * @param  {[type]} e) {               	e.preventDefault();    	let env [description]
     * @return {[type]}    [description]
     */
    $('#frmSendWithResume').on('submit', function (e) {
    	e.preventDefault();

    	let env = this;
    	let route = $(env).attr('action');

    	$.ajax({
				type: 'POST',
				url: route,
	            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				dataType: 'json',
				data: ($('input[name=resume]:checked').val() == 0) ? '' : $(env).serialize(),
				beforeSend: function () {
					$('button', env).html("Cargando...");
					blockForm();
				}, 
				error: function (jqXHR, textStatus, errorThrown) {
					$('button', env).html('Enviar');

					unblockForm();
				},
				success: function (response) {
					$('button', env).html('Enviar');

					if (response.errors == false) {
						$.jnoty(response.message, {
							header: 'Éxito',
	                        theme: 'jnoty-success',
	                        life: 5000,
	                        position: 'top-right',
	                        icon: 'fa fa-check-circle'
						});

						//Delete bookmark button
						$('.bookmark-wrapper-rti').remove();

						$('.mfp-close').click();

						$('.apply-now-button').attr('href', '');
						$('.apply-now-button').removeClass('lets-apply');
						$('.apply-now-button').removeClass('popup-with-zoom-anim');
						$('.apply-now-button').html('¡Gracias por aplicar!');
						$('.apply-now-button').addClass('btn-has-applied');
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


	//Let's apply button
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

						//Delete bookmark button
						$('.bookmark-wrapper-rti').remove();

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