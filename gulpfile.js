//gulpプラグインの読み込み
var gulp = require("gulp");

//画像を圧縮するプラグインの読み込み
var imagemin = require("gulp-imagemin");
var pngquant = require("imagemin-pngquant");
var mozjpeg = require("imagemin-mozjpeg");
//jsを圧縮するプラグインの読み込み
var uglify = require('gulp-uglify');

/*******************************************
 * imgフォルダのpng, jpg画像を圧縮して, minfied_imageフォルダに保存する
 *******************************************/
gulp.task("imageMinTask", function() {	//「imageMinTask」という名前のタスクを登録
	return gulp
		.src(["assets/img/*.{png,jpg}","assets/img/**/*.{png,jpg}"],{base: "assets/img"})	//各テーマのimgフォルダ以下のpng, jpgフォルダ画像を取得
		.pipe(imagemin([
			pngquant({
				quality: [0.65,0.8],
				speed: 1,
				floyd: 0
			}),
			mozjpeg({
				quality: 85,
				progressive: true
			}),
			imagemin.svgo(),
			imagemin.optipng(),
			imagemin.gifsicle()
		]))
		.pipe(gulp.dest("assets/dist/img/"));	//保存
});

/*******************************************
 * JSファイルの圧縮
 * @return {Stream} 
 *******************************************/
gulp.task('min-js', function() {
	return gulp
		.src("assets/js/script.js")
		.pipe(uglify({
			compress: true,	//圧縮する
			mangle: true,	//変数の難読化を行う
		})
			.on('error', function(e){
				console.log(e);
			}) 
		)
		.pipe(gulp.dest('assets/dist/js/'));
});