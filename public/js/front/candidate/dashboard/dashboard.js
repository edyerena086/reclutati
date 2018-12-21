$(document).ready(function () {
	$('.btn-noty-mark-as-read').on('click', function (e) {
		e.preventDefault();

		var env = this;

		var route = $(env).attr('href');

		$.ajax({
			type: 'GET',
			url: route,
			dataType: 'json',
			beforeSend: function () {
				blockForm();
			},
			error: function (jqXHR, textStatus, errorThrown) {

				$.jnoty("No se ha podido marcar como leída la notificación.", {
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

					var position = $('.btn-noty-mark-as-read').index(env);

					$('.notifications-list li:eq('+position+')').remove();
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

		//console.log($('.btn-noty-mark-as-read').index(env));
	});

	//Mark all as read
	$('.mark-as-read').on('click', function (e) {
		e.preventDefault();

		let env = this;

		let notificationItems = $('.notifications-list li').length;

		if (notificationItems > 0) {
			$.get($(this).attr('data-url'), function (response) {
				if (response.errors == false) {
					$('.notifications-list').empty();

					$.jnoty(response.message, {
						header: 'Éxito',
				        theme: 'jnoty-success',
				        life: 5000,
				        position: 'top-right',
				        icon: 'fa fa-check-circle'
					});

					$('#notyCounter').html('0');
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
			});
		}
	});
});