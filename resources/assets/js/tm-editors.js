import tinymce from 'tinymce';

import './tinymce-plugins/charactercount';

tinymce.init({
  selector: 'textarea.tinymce',
  theme: 'modern',
  skin: 'lightgray',
  branding: false,
  paste_as_text: true,

  width: '100%',
  height: 500,

  statubar: false,

  plugins: [
    'paste',
    'lists',
    'link',
    'autolink',
    'autosave',
    'emoticons',
    'fullscreen',
    'image',
    'insertdatetime',
    'preview',
    'wordcount',
  ],

  // toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | link image | bullist numlist outdent indent',
});

tinymce.init({
  selector: 'textarea.tinymce.simple',
  paste_as_text: true,
  toolbar: false,
  menubar: false,
  plugins: [
    'paste',
    'charactercount',
  ],
});

tinymce.init({
  selector: 'textarea.tinymce.advanced',

  theme: 'modern',
  skin: 'lightgray',
  branding: false,

  width: '100%',
  height: 500,

  statubar: true,

  plugins: [
    'advlist autolink link image lists charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
    'save table contextmenu directionality emoticons template paste textcolor',
  ],

  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
});
