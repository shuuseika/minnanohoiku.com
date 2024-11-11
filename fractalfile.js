'use strict';

/* Create a new Fractal instance and export it for use elsewhere if required */
const fractal = module.exports = require('@frctl/fractal').create();

/* Set the title of the project */
fractal.set('project.title', 'FooCorp Component Library');
fractal.set('project.version', 'v1.0.0');
fractal.set('project.author', 'T.Niki');

/* Tell Fractal where the components will live */
fractal.components.set('path', __dirname + '/_themes/default/styleguide/components');

/* Tell Fractal where the documentation pages will live */
fractal.docs.set('path', __dirname + '/_themes/default/styleguide/docs');

fractal.web.set('static.path', __dirname + '/');

/* デフォルトプレビューの設定 */
fractal.components.set('default.preview', '@preview01');

/* 静的ファイルの書き出し */
fractal.web.set('builder.dest', __dirname + '/styleguide/dist');

// browsersync設定
fractal.web.set('server.sync', true);
fractal.web.set('server.syncOptions', {
  open: true,
  rule: {
    match: /<\/body>/i,
    fn: function (snippet, match) {
      return snippet + match;
    }
  }
});