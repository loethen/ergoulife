define(function(require,exports,module){
	var $ = require('jquery')
	require('jquery.hoverdir')
	$(' #da-thumbs > li ').each( function() { 
		$(this).hoverdir();
	} )
})