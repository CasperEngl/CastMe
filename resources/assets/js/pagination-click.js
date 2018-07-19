$(document).on('click', '.page-link', (e) => {
	const forId = $(e.target).attr('for');
	const hiddenInput = $('#' + forId).attr('type');

	if (hiddenInput === 'radio') {
		$(e.target).parent().siblings().removeClass('active');
		$(e.target).parent().addClass('active');
	}

	if (hiddenInput === 'checkbox') {
		console.log($(e.target).parent().hasClass('active'));
		if ($(e.target).parent().hasClass('active')) {
			$(e.target).parent().removeClass('active');
		} else {
			$(e.target).parent().addClass('active');
		}
	}
});