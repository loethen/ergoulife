define(function(require,exports){
	var $ = require('jquery')
	$('#avatar').change(function(){
		$('.form-avatar').submit();
	})
})