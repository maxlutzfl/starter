/**
 * Import scripts
 */

var gulp = require('gulp') ;
var sass = require('gulp-sass') ;
var watch = require('gulp-watch') ;
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var autoprefixer = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');

/**
 * Setup "sass" task
 */

gulp.task('sass', function() {

	return gulp.src('_assets/styles/brandco.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(gulp.dest('_assets/styles/.'))		
		.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(rename('_assets/styles/brandco.min.css'))
		.pipe(livereload())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('.'));

});

/**
 * Setup "scripts" task
 */

gulp.task('scripts', function() {
	return gulp.src('_assets/scripts/scripts/*.js')
		.pipe(concat('all-scripts.js'))
		.pipe(jshint())
		.pipe(gulp.dest('_assets/scripts'))
		.pipe(rename('brandco.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('_assets/scripts'));
});

/**
 * Setup "browser-sync" task
 */

gulp.task('browser-sync', function() {

	// Watch for changes in .sass files and run the sass task
	gulp.watch( '_assets/styles/**/*.scss', ['sass'] );

	// Watch for changes in .js files and run the scripts task
	gulp.watch( '_assets/scripts/scripts/*.js', ['scripts'] );

	// BrowserSync settings
	browserSync({
		files: [
			"_assets/styles/brandco.min.css",
			"_assets/scripts/brandco.min.js",
			"**/*.php"
		],

		/**
		 *
		 */
		proxy: "starter.bco",
		snippetOptions: {
			ignorePaths: ["http://localhost:3000/wp-admin/**"],
		},		
	});

});

/**
 * Setup default "gulp" task
 */

gulp.task( 'default', ['browser-sync'] );







