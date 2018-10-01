import tinymce from 'tinymce';
import getLocale from './getLocale';

import './tinymce-plugins/charactercount';

(async () => {
  const locale = await getLocale() === 'da' ? 'da' : 'en';

  const locales = {
    en: {
      headers: {
        title: 'Headers',
        h1: 'Heading',
        h2: 'Title',
        h3: 'Subheading',
        h4: 'Between Headline',
        h5: 'Footnote',
      },
      inline: {
        title: 'Inline',
        bold: 'Bold',
        italic: 'Italic',
        underline: 'Underline',
        strikethrough: 'Strikethrough',
        superscript: 'Superscript',
        subscript: 'Subscript',
        code: 'Code',
      },
      blocks: {
        paragraph: 'Paragraph',
        blockquote: 'Blockquote',
        div: 'Div',
        pre: 'Pre',
      },
      alignment: {
        title: 'Alignment',
        left: 'Left',
        center: 'Center',
        right: 'Right',
        justify: 'Justify',
      },
    },
    da: {
      headers: {
        title: 'Overskrifter',
        h1: 'Overskrift',
        h2: 'Titel',
        h3: 'Underoverskrift',
        h4: 'Mellemoverskrift',
        h5: 'Fodnote',
      },
      inline: {
        title: 'Linje',
        bold: 'Bold',
        italic: 'Italic',
        underline: 'Underline',
        strikethrough: 'Strikethrough',
        superscript: 'Superscript',
        subscript: 'Subscript',
        code: 'Kode',
      },
      blocks: {
        title: 'Blokke',
        paragraph: 'Brødtekst',
        blockquote: 'Blokcitat',
        div: 'Div',
        pre: 'Pre',
      },
      alignment: {
        title: 'Justering',
        left: 'Venstre',
        center: 'Centrer',
        right: 'Højre',
        justify: 'Ligestil',
      },
    },
  };

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

  // Simple Editor
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

    style_formats: [
      {
        title: locales[locale].headers.title,
        items: [
          { title: locales[locale].headers.h1, format: 'h2' },
          { title: locales[locale].headers.h2, format: 'h3' },
          { title: locales[locale].headers.h3, format: 'h4' },
          { title: locales[locale].headers.h4, format: 'h5' },
          { title: locales[locale].headers.h5, format: 'h6' },
        ],
      },
      {
        title: locales[locale].inline.title,
        items: [
          { title: locales[locale].inline.bold, icon: 'bold', format: 'bold' },
          { title: locales[locale].inline.italic, icon: 'italic', format: 'italic' },
          { title: locales[locale].inline.underline, icon: 'underline', format: 'underline' },
          { title: locales[locale].inline.strikethrough, icon: 'strikethrough', format: 'strikethrough' },
          { title: locales[locale].inline.superscript, icon: 'superscript', format: 'superscript' },
          { title: locales[locale].inline.subscript, icon: 'subscript', format: 'subscript' },
          { title: locales[locale].inline.code, icon: 'code', format: 'code' },
        ],
      },
      {
        title: locales[locale].blocks.title,
        items: [
          { title: locales[locale].blocks.paragraph, format: 'p' },
          { title: locales[locale].blocks.blockquote, format: 'blockquote' },
          { title: locales[locale].blocks.div, format: 'div' },
          { title: locales[locale].blocks.pre, format: 'pre' },
        ],
      },
      {
        title: locales[locale].alignment.title,
        items: [
          { title: locales[locale].alignment.left, icon: 'alignleft', format: 'alignleft' },
          { title: locales[locale].alignment.center, icon: 'aligncenter', format: 'aligncenter' },
          { title: locales[locale].alignment.right, icon: 'alignright', format: 'alignright' },
          { title: locales[locale].alignment.justify, icon: 'alignjustify', format: 'alignjustify' },
        ],
      },
    ],
  });

  // Advanced Editor
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

    style_formats: [
      {
        title: locales[locale].headers.title,
        items: [
          { title: locales[locale].headers.h1, format: 'h2' },
          { title: locales[locale].headers.h2, format: 'h3' },
          { title: locales[locale].headers.h3, format: 'h4' },
          { title: locales[locale].headers.h4, format: 'h5' },
          { title: locales[locale].headers.h5, format: 'h6' },
        ],
      },
      {
        title: locales[locale].inline.title,
        items: [
          { title: locales[locale].inline.bold, icon: 'bold', format: 'bold' },
          { title: locales[locale].inline.italic, icon: 'italic', format: 'italic' },
          { title: locales[locale].inline.underline, icon: 'underline', format: 'underline' },
          { title: locales[locale].inline.strikethrough, icon: 'strikethrough', format: 'strikethrough' },
          { title: locales[locale].inline.superscript, icon: 'superscript', format: 'superscript' },
          { title: locales[locale].inline.subscript, icon: 'subscript', format: 'subscript' },
          { title: locales[locale].inline.code, icon: 'code', format: 'code' },
        ],
      },
      {
        title: locales[locale].blocks.title,
        items: [
          { title: locales[locale].blocks.paragraph, format: 'p' },
          { title: locales[locale].blocks.blockquote, format: 'blockquote' },
          { title: locales[locale].blocks.div, format: 'div' },
          { title: locales[locale].blocks.pre, format: 'pre' },
        ],
      },
      {
        title: locales[locale].alignment.title,
        items: [
          { title: locales[locale].alignment.left, icon: 'alignleft', format: 'alignleft' },
          { title: locales[locale].alignment.center, icon: 'aligncenter', format: 'aligncenter' },
          { title: locales[locale].alignment.right, icon: 'alignright', format: 'alignright' },
          { title: locales[locale].alignment.justify, icon: 'alignjustify', format: 'alignjustify' },
        ],
      },
    ],
  });
})();
