module.exports = ctx => ({
  map: ctx.options.map,
  plugins: {
    //'postcss-import': {},
    //'postcss-mixins': {},
    'postcss-custom-media': {},
    //'postcss-custom-properties': {preserve: false},
    'postcss-color-function': {},
    'autoprefixer': {},
    //'postcss-nested': {},
    'csswring': {}
  }
});