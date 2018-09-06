import $ from 'jquery';

$(() => {
  $('.selectpicker').selectpicker();
});

$('.selectpicker').change((event) => {
  $(event.target).closest('form').submit();
});
