define(function(require,exports){
	var $ = require('jquery'),
		f = $('#focus'),
		fav = $('.favorite'),
		offset1 = f.offset(),
		offset2 = fav.offset(),
		fw = f.width(),
		fl = fw/2;
		
	exports.move = function(){
		var cf = $('.favorite').clone()
		cf.appendTo('body')
		  .css({
		  	'position':'fixed',
		  	'left':offset1.left+fl,
		  	'top':offset1.top-20-$(window).scrollTop(),
		  	'z-index':'9999'
		  })
		cf.animate({
			left:offset2.left,
			top:offset2.top
		},1000,function(){
			cf.hide().remove()
		})
	}
})