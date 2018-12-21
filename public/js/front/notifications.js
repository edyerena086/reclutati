$(document).ready(function () {
	$('#displayNotifications').on('click', function() {
		let env = this;

		$.get($(env).attr('href'), function (response) {
				if (response.errors == false) {
					$('#notyCounter').html('0');
				}
			});
	})
});