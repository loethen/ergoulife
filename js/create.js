define(function(require){
	var $ = require('jquery')
	$.fn.coffee = function(obj){  
	  for(var eName in obj)  
	    for(var selector in obj[eName])  
	      $(this).on(eName, selector, obj[eName][selector])  
	}
	var gc = $('.guid-wrap')
	gc.coffee({
		'click':{
			'#taobao':function(){
				var choose = $(this).parent(),
					w = choose.height()

				choose.animate({
					top:-w*2
				},function(){
					choose.hide()
					gc.find('.tb').show()
				})

				$('li.guid-step2').addClass('current')
								  .find('span').addClass('badge-warning')
			},
			'#othersite':function(){
				alert('fuck')
			}
		}
	})
})