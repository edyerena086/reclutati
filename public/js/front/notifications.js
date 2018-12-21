$(document).ready(function () {
	$('#displayNotifications').on('click', function() {
		let env = this;

		console.log();

		if ($(env).parent().parent().hasClass('active')) {
			$.get($(env).attr('href'), function (response) {
				if (response.errors == false) {
					$('#notyCounter').html('0');
				}
			});
		}
	})
});