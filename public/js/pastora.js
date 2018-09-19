function blockForm()
{
	actionForm(true);
}

function unblockForm()
{
	actionForm(false);
}

function actionForm(block)
{
	$('input, select, button, a').attr('disabled', block);
}

/**
 * [initMagnificPopup description]
 * @return {[type]} [description]
 */
function initMagnificPopup()
{
	$('.popup-with-zoom-anim').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in'
	});
}