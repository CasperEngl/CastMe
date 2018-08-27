import $ from 'jquery';

$('#avatar').fileinput({
  overwriteInitial: true,
  maxFileSize: 2000,
  showClose: false,
  showCaption: false,
  browseLabel: 'Select file',
  removeLabel: 'Remove file',
  browseIcon: '<i class="fas fa-folder-open"></i>',
  removeIcon: '<i class="fas fa-trash"></i>',
  elErrorContainer: '#avatar-errors',
  msgErrorClass: 'alert alert-block alert-danger',
  defaultPreviewContent: '<img src="/avatar/avatar-64.png" alt="your avatar">',
  allowedFileExtensions: ['jpg', 'png', 'gif'],
});
