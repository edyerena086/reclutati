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