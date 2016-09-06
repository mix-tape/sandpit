// ==========================================================================
//
//  Gulp Config
//    Default build for development will watch and recompile, with debug
//    information on each change of local styleheets + javascript files.
//
// ==========================================================================


var gulp = require('gulp'),
		plugins = require('gulp-load-plugins')(),
		mainBowerFiles = require('main-bower-files'),
		browserSync = require('browser-sync'),
		reload = browserSync.reload,
		merge = require('merge-stream'),
		del = require('del'),
		path = require('path'),
		fs = require("fs");

// --------------------------------------------------------------------------
//   Configuration
// --------------------------------------------------------------------------

var bowerrc = JSON.parse(fs.readFileSync('.bowerrc', 'utf8'));

var config = {
	url: 'hibiki.dev',
	styles: './assets/styles',
	scripts: './assets/scripts',
	images: './assets/images',
	icons: './assets/icons',
	vendor: bowerrc.directory
}


// --------------------------------------------------------------------------
//   Remove all existing compiled files
// --------------------------------------------------------------------------

gulp.task('clean', function () {
	return del(['./style.css']);
});


// --------------------------------------------------------------------------
//   Browser Sync
// --------------------------------------------------------------------------

gulp.task('browser-sync', function() {

	var files = [
					'**/*.php',
					'**/*.{png,jpg,gif}'
				];

	browserSync.init({

		// Read here http://www.browsersync.io/docs/options/
		proxy: config.url,
		open: 'external',
		files: files,
		// host: "192.168.0.114",

		// port: 8080,

		// Tunnel the Browsersync server through a random Public URL
		// tunnel: true,

		// Attempt to use the URL "http://my-private-site.localtunnel.me"
		// tunnel: "ppress",

		// Inject CSS changes
		injectChanges: true,

		middleware: function (req, res, next) {
			res.setHeader('Access-Control-Allow-Origin', '*');
			next();
		},

		// Fix a conflict with the IE8 conditional body tag
		snippetOptions: {
			whitelist: ['/wp-admin/admin-ajax.php'],
			rule: {
				match: /<\/body>/i,
				fn: function (snippet, match) { return snippet + match; }
			}
		}

	});
});


// --------------------------------------------------------------------------
//   Compile SCSS into CSS stylesheet
// --------------------------------------------------------------------------

gulp.task('styles', function () {
	return gulp.src(config.styles + '/main.scss')
		.pipe(plugins.plumber())
		.pipe(plugins.cssGlobbing({
			extensions: ['.css', '.scss']
		}))
		.pipe(plugins.sass({
			style: 'expanded',
			quiet: true,
			sourcemap: true,
			sourcemapPath: './',
			includePaths: [ config.vendor ]
		}).on('error', plugins.sass.logError))
		.pipe(plugins.groupCssMediaQueries())
		.pipe(plugins.autoprefixer("last 3 version", "> 1%", "ie 8", "ie 7"))
		.pipe(plugins.rename('style.css'))
		.pipe(gulp.dest('./'))
		.pipe(reload({stream:true}));
});


// --------------------------------------------------------------------------
//   Compile SCSS and minify into CSS stylesheet
// --------------------------------------------------------------------------

gulp.task('ugly-styles', function () {
	return gulp.src(config.styles + '/main.scss')
		.pipe(plugins.plumber())
		.pipe(plugins.cssGlobbing({
			extensions: ['.css', '.scss']
		}))
		.pipe(plugins.sass({
			style: 'compressed',
			quiet: true,
			sourcemap: true,
			sourcemapPath: '.',
			includePaths: [ config.vendor ]
		}).on('error', plugins.sass.logError))
		.pipe(plugins.groupCssMediaQueries())
		.pipe(plugins.autoprefixer("last 3 version", "> 1%", "ie 8", "ie 7"))
		.pipe(plugins.cssnano())
		.pipe(plugins.rename('style.css'))
		.pipe(gulp.dest('./'));
});


// --------------------------------------------------------------------------
//   Concat all script files required into `plugins.js`
// --------------------------------------------------------------------------

gulp.task('bower-scripts', function () {
	return gulp.src( mainBowerFiles( { filter: /.*\.js$/i } ) )
		.pipe(plugins.plumber())
		.pipe(plugins.order(['*jquery.js*', '*angular.js*']))
		.pipe(plugins.concat('vendor.js'))
		.pipe(gulp.dest(config.scripts));
});


// --------------------------------------------------------------------------
//   Concat + uglify all script files required into `all.min.js`
// --------------------------------------------------------------------------

gulp.task('bower-ugly-scripts', function () {
	return gulp.src( mainBowerFiles( { filter: /.*\.js$/i } ) )
		.pipe(plugins.plumber())
		.pipe(plugins.order(['*jquery.js*', '*angular.js*']))
		.pipe(plugins.uglify({
			mangle: false,
			compress: false,
			preserveComments: false
		}))
		.pipe(plugins.concat('vendor.js'))
		.pipe(gulp.dest(config.scripts));
});


// --------------------------------------------------------------------------
//   Concat all user script files required into `scripts.js`
// --------------------------------------------------------------------------

gulp.task('scripts', function () {
	return gulp.src( [config.scripts + '/utilities/*.js', config.scripts + '/modules/*.js']  )
		.pipe(plugins.plumber())
		.pipe(plugins.order(['module.init.js']))
		.pipe(plugins.concat('app.js'))
		.pipe(gulp.dest(config.scripts));
});


// --------------------------------------------------------------------------
//   Concat all user script files required into `scripts.js`
// --------------------------------------------------------------------------

gulp.task('ugly-scripts', function () {
	return gulp.src( [config.scripts + '/utilities/*.js', config.scripts + '/modules/*.js']  )
		.pipe(plugins.plumber())
		.pipe(plugins.uglify({
			mangle: true,
			compress: true,
			preserveComments: false
		}))
		.pipe(plugins.concat('app.js'))
		.pipe(gulp.dest(config.scripts));
});


// --------------------------------------------------------------------------
//   Optimise all images
// --------------------------------------------------------------------------

gulp.task('images', function () {
	return gulp.src([
			config.images + "/*",
			config.images + "/**/*"])
		.pipe(plugins.plumber())
		.pipe(plugins.imagemin({
			optimizationLevel: 5,
			progressive: true
		}))
		.pipe(gulp.dest(config.images));
});


// --------------------------------------------------------------------------
//   Compile Fonts
// --------------------------------------------------------------------------

gulp.task('compile-icons', function () {

	gulp.src([ config.icons + '/svg/*.svg'])
		.pipe(plugins.iconfont({
			fontName: 'icons',
			fontHeight: 150,
			normalize: true,
			descent: 0
		}))
		.on('glyphs', function(glyphs, options) {

			var options = {
						glyphs: glyphs,
						fontName: 'icons',
						fontPath: 'assets/icons/font/',
						className: 'icon'
					};

			gulp.src(config.icons + '/templates/icons.scss')
				.pipe(plugins.consolidate('lodash', options))
				.pipe(plugins.rename('_icons.scss'))
				.pipe(gulp.dest( config.styles + '/base/'));

			gulp.src(config.icons + '/templates/icons.css')
				.pipe(plugins.consolidate('lodash', options))
				.pipe(plugins.rename('icons.css'))
				.pipe(gulp.dest( config.icons + '/css/'));

			gulp.src(config.icons + '/templates/icons.html')
				.pipe(plugins.consolidate('lodash', options))
				.pipe(gulp.dest( config.icons + '/demo/'));

		})
		.pipe(gulp.dest( config.icons + '/font/'));
});


// --------------------------------------------------------------------------
//   Watch
// --------------------------------------------------------------------------

gulp.task('watch', function () {

	gulp.watch( config.styles + '/**/*.scss', ['styles']);
	gulp.watch( config.scripts + '/**/*.js', ['scripts']);
	gulp.watch( './bower.json', ['bower-scripts', reload]);

});


// --------------------------------------------------------------------------
//   Run development level tasks, and watch for changes
// --------------------------------------------------------------------------

gulp.task('default', [ 'clean', 'styles', 'scripts', 'bower-scripts', 'browser-sync', 'watch']);


// --------------------------------------------------------------------------
//   Run production tasks including minfication, and without watch
// --------------------------------------------------------------------------

gulp.task('build', ['clean', 'ugly-styles', 'bower-ugly-scripts', 'scripts']);
