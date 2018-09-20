/*
eslint

func-names: 0,
*/

import tinymce from 'tinymce';

tinymce.PluginManager.add('charactercount', function (editor) {
  const self = this;

  function update() {
    editor.theme.panel.find('#charactercount').text(['{0}', self.getCount()]);
  }

  editor.on('init', () => {
    const statusbar = editor.theme.panel && editor.theme.panel.find('#statusbar')[0];

    if (statusbar) {
      window.setTimeout(() => {
        statusbar.insert({
          type: 'label',
          name: 'charactercount',
          text: ['{0}', self.getCount()],
          classes: 'charactercount',
          disabled: editor.settings.readonly,
        }, 0);

        editor.on('setcontent beforeaddundo', update);

        editor.on('keyup', (e) => {
          update();
        });
      }, 0);
    }
  });

  function decodeHtml(html) {
    const txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
  }

  self.getCount = function () {
    const tx = editor.getContent({ format: 'raw' });
    const decoded = decodeHtml(tx);
    const decodedStripped = decoded.replace(/(<([^>]+)>)/ig, '').trim();
    const tc = decodedStripped.length;

    return tc;
  };
});
