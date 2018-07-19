$(document).on('click', '.page-link', (e) => {
	const forId = $(e.target).attr('for');
	const input = $('#' + forId).attr('type');

	if (input === 'radio') {
		$(e.target).parent().siblings().removeClass('active');
		$(e.target).parent().addClass('active');
	}

	if (input === 'checkbox') {
		if ($(e.target).parent().hasClass('active')) {
			$(e.target).parent().removeClass('active');
		} else {
			$(e.target).parent().addClass('active');
		}
	}
});