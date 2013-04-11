seajs.config({
	plugins : ['shim'],
	shim : {
		'jquery': {
			src : 'vendor/jquery-1.8.3.min.js',
			exports : 'jQuery'
		},
		'hoverdir': {
			src : 'vendor/jquery.hoverdir.js',
			deps : ['jquery']
		},
		'bootstrap': {
			src : 'vendor/bootstrap.js',
			deps : ['jquery']
		},
		'jcrop': {
			src : 'vendor/jquery.Jcrop.js',
			deps : ['jquery']
		},
		'raty': {
			src : 'vendor/jquery.raty.min.js',
			deps : ['jquery']
		},
		'spritely': {
			src : 'vendor/jquery.spritely.js',
			deps : ['jquery']
		},
		'easing':{
			src : 'vendor/jquery.easing.js',
			deps : ['jquery']
		},
		'colorbox':{
			src : 'vendor/colorbox.js',
			deps : ['jquery']
		},
		'ajaxform':{
			src : 'vendor/jquery.form.js',
			deps : ['jquery']
		},
		'ueditor':{
			src : 'ueditor/editor_all.js',
			exports : 'UE'
		}
	}
})