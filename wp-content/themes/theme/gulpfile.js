/**
 Setup
 */

var devURL = 'starter.bco';

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
var notify = require('gulp-notify');
var gulpSassLint = require('gulp-sass-lint');

/**
 * Setup "sass" task
 */

gulp.task('sass', function() {

	return gulp.src('resources/styles/scss/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.on('error', notify.onError(function(error) {
			return error.message;
		}))
		.pipe(gulp.dest('resources/styles/css/.'))
		.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(rename('resources/styles/css/main.min.css'))
		.pipe(livereload())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('.'));
});

/**
 * Setup "scripts" task
 */

gulp.task('scripts', function() {
	return gulp.src(['resources/scripts/plugins/*.js', 'resources/scripts/scripts/*.js'])
		.pipe(plumber())
		.pipe(jshint())
		// .pipe(jshint.reporter('default'))
		.pipe(sourcemaps.init())
		.pipe(concat('main.js'))
		.pipe(gulp.dest('resources/scripts'))
		.pipe(rename('main.min.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('resources/scripts'));
});

/**
 * Setup "browser-sync" task
 */

gulp.task('browser-sync', function() {

	// Watch for changes in .sass files and run the sass task
	gulp.watch('resources/styles/scss/**/*.scss', ['sass']);

	// Watch for changes in .js files and run the scripts task
	gulp.watch('resources/scripts/scripts/*.js', ['scripts']);

	// BrowserSync settings
	browserSync({
		open: false,
		files: [
			"resources/styles/css/main.min.css",
			"resources/scripts/main.min.js",
			"**/*.php"
		],

		/**
		 *
		 */
		proxy: devURL,
		snippetOptions: {
			ignorePaths: ["http://localhost:3000/wp-admin/**"],
		},
	});

});

/**
 * Setup default "gulp" task
 */

gulp.task( 'default', ['browser-sync'] );
