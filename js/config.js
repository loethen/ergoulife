seajs.config({
	plugins : ['seajs/shim'],
	alias : {
		'jquery': {
			src : 'vendor/jquery-1.8.3.min.js',
			exports : "jQuery"
		}
	},
	paths :{
		'vendor' : 'http://localhost/ergoulife/js/vendor'
	}
	base: 'http://localhost/ergoulife/js/',
	debug: true
})