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
var livereload = require('gulp-livereload');

// Lint Task
gulp.task('lint', function() {
	return gulp.src('_assets/scripts/scripts/theme-custom.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
		.pipe(livereload());
});

// Compile Our Sass
gulp.task('sass', function() {
	return gulp.src('_assets/styles/brandco.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'}))
		.pipe(autoprefixer())
		.pipe(rename('_assets/styles/brandco.min.css'))
		.pipe(livereload())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('.'));
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
	livereload.listen();
	gulp.watch('_assets/scripts/scripts/theme-custom.js', ['lint', 'scripts']);
	gulp.watch('_assets/styles/**/*.scss', ['sass']);
	gulp.watch('**/*.php').on('change', function(file) {
		livereload.changed(file.path);
	});
});

// Default Task
gulp.task('default', ['lint', 'sass', 'scripts', 'watch']);