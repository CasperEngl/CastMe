import $ from 'jquery';

function toggleAffix(affixElement, scrollElement, wrapper) {
  const top = wrapper.offset().top - 50;

  if (scrollElement.scrollTop() >= top) {
    affixElement.addClass('affix');
  } else {
    affixElement.removeClass('affix');
  }
}

$('[data-toggle="affix"]').each((index, value) => {
  const el = $(value);
  const wrapper = $('<div></div>');

  el.before(wrapper);
  $(window).on('scroll resize', () => {
    toggleAffix(el, $(window), wrapper);
  });

  // init
  toggleAffix(el, $(window), wrapper);
});
