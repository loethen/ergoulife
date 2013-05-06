define(function(require){
	var $ = require('jquery')

	if($('html').hasClass('no-textshadow')){
		require.async('placeholder',function(){
			$('input[type=text]').placeholder()	
		})
	}
	var gc = $('.guid-wrap'),
		lock = false
	gc.coffee({
		'click':{
			'#taobao':function(){
				var choose = $(this).parent(),
					h = choose.height()

				choose.animate({
					top:-h*2
				},function(){
					choose.hide()
					gc.find('.tb').show()
				})

				$('li.guid-step2').addClass('current')
								  .find('span').addClass('badge-warning')

				require.async('./taobao')
			},
			'#othersite':function(){
				var choose = $(this).parent(),
					h = choose.height()

				choose.animate({
					top:-h*2
				},function(){
					choose.hide()
					gc.find('.other').show()
				})

				$('li.guid-step2').addClass('current')
								  .find('span').addClass('badge-warning')

				require.async('./b2c')
			}
			
		}
	})
	
})