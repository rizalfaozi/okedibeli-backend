let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 	mix.js('resources/assets/js/apps/members.js', 'public/vue/js')
 	.js('resources/assets/js/apps/homes.js', 'public/vue/js')
	
	.js('resources/assets/js/apps/admins.js', 'public/vue/js').version();

	mix.styles([
	    'public/css/styles.min.css',
		'public/css/custom.css',
		'public/css/styles-blessed3.css',
		'public/css/styles-blessed2.css',
		'public/css/styles-blessed1.css',
		'public/plugins/codeprettifier/prettify.css',
		'public/plugins/datepicker/datepicker3.css',
		'public/plugins/switchery/switchery.css',
		'public/plugins/iCheck/skins/minimal/_all.css',
		'public/plugins/iCheck/skins/flat/_all.css',
		'public/plugins/iCheck/skins/square/_all.css',
	], 'public/vue/css/bundle.css').version();
	mix.scripts([
	    'public/js/jquery-1.10.2.min.js',
		'public/js/jqueryui-1.9.2.min.js',
	    'public/js/application.js',
	    'public/demo/demo-switcher.js',
		'public/js/bootstrap.min.js',
		'public/js/enquire.min.js',
		'public/plugins/bootstrap-switch/bootstrap-switch.js',
		'public/plugins/switchery/switchery.js',
		'public/plugins/datepicker/bootstrap-datepicker.js',
		'public/plugins/codeprettifier/prettify.js',
		'public/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js',
		'public/plugins/iCheck/icheck.min.js',
		'public/plugins/nanoScroller/js/jquery.nanoscroller.min.js',
		'public/plugins/clockface/js/clockface.js',
		'public/js/custom.js'
	], 'public/vue/js/bundle.js').version();
