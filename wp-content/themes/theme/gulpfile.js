// Include gulp
var gulp = require('gulp'); 

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');
var livereload = require('gulp-livereload');

// Lint Task
gulp.task('lint', function() {
	return gulp.src('_assets/scripts/scripts/theme-custom.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
	gulp.src('_assets/styles/brandco.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({errLogToConsole: true}))
		.pipe(autoprefixer())
		.pipe(minifyCSS({keepBreaks:false}))
		.pipe(rename('_assets/styles/brandco.min.css'))
		.pipe(gulp.dest('.'))
		.pipe(livereload());
});

// Compile Our Sass
gulp.task('headerfootercss', function() {
	gulp.src('_assets/styles/headerfooter.scss')
		.pipe(autoprefixer())
		.pipe(minifyCSS({keepBreaks:false}))
		.pipe(rename('_assets/styles/header-footer.min.css'))
		.pipe(gulp.dest('.'))
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
	return gulp.src('_assets/scripts/scripts/*.js')
		.pipe(concat('all-scripts.js'))
		.pipe(gulp.dest('_assets/scripts'))
		.pipe(rename('brandco.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('_assets/scripts'));
});

// Watch Files For Changes
gulp.task('watch', function() {
	var server = livereload();
	gulp.watch('_assets/scripts/scripts/theme-custom.js', ['lint', 'scripts']);
	gulp.watch('_assets/styles/**/*.scss', ['sass']);
	gulp.watch('_assets/styles/**/*.scss', ['headerfootercss']);
	gulp.watch('**/*.php').on('change', function(file) {
		livereload.changed(file.path);
	});
	livereload.listen();
});

// Default Task
gulp.task('default', ['lint', 'sass', 'headerfootercss', 'scripts', 'watch']);