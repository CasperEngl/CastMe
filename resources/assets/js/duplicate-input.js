$(() => {

  $(document).on('click', '.duplicate-input-group-button', (e) => {
    e.preventDefault();
  
    const group = $(e.target).closest('.row').siblings('.form-group:last-of-type');
    const duplicate = group.clone();
    duplicate.find('.form-control').val('');
  
    group.after(duplicate);
  });

  $(document).on('click', '.remove-input-group-button', (e) => {
    e.preventDefault();

    // Check if the remove input group button is the only one in the DOM
    if ($('.remove-input-group-button').length > 1) {
      // Remove the form group
      $(e.target).closest('.form-group').remove();
    }
  });

});