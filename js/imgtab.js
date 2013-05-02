define(function(require){
	var $ = require('jquery')
	$.fn.coffee = function(obj){  
	  for(var eName in obj)  
	    for(var selector in obj[eName])  
	      $(this).on(eName, selector, obj[eName][selector])  
	}
	$('.rxitems').coffee({
		'click':{
			'.mini-img a':function(){
				var src = $(this).find('img').attr('src')
				src = src.replace(/40x40/i,'400x400')
				var fg = $(this).closest('.fg')
				fg.find('.large-img>a>img').attr('src',src)
			}
		}
	})
})