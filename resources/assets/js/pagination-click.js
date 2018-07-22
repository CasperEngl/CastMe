/*
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
*/

$.map($('input:checked'), input => {
  $('[for^="' + input.id + '"]')
    .parent()
    .addClass('active');
});

$('input').change(function() {
  // Set variable for the 'this' input for easy usage
  const input = $(this);
  // Find the corresponding label
  const label = $('[for^="' + this.id + '"]');

  // If input is a radio
  if (input.is(':radio')) {
    label
      .parent()
      .siblings()
      .removeClass('active');
		label
			.parent()
			.addClass('active');
  }

  // If input is a checkbox
  if (input.is(':checkbox')) {
    // If the pagination is already active
    if (label.parent().hasClass('active')) {
      // Remove the active class
			label
				.parent()
				.removeClass('active');
    } else {
      // If the pagination is not already active
      // Add the active class
			label
				.parent()
				.addClass('active');
    }
  }
});
