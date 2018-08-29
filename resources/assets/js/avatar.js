import $ from 'jquery';

$('#avatar').fileinput({
  overwriteInitial: true,
  maxFileSize: 2000,
  autoOrientImage: false,
  showClose: false,
  showCaption: false,
  showUpload: false,
  browseLabel: 'Select file',
  removeLabel: 'Remove file',
  browseIcon: '<i class="fas fa-folder-open"></i>',
  removeIcon: '<i class="fas fa-trash"></i>',
  elErrorContainer: '#avatar-errors',
  msgErrorClass: 'alert alert-block alert-danger',
  allowedFileExtensions: ['jpg', 'jpeg', 'png'],
});
