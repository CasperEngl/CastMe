$(document).on('click', '.page-link', (e) => {
	$(e.target).parent().siblings().removeClass('active');
	$(e.target).parent().addClass('active');
});