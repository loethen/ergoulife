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
			},
			'#loaditem':function(){
				var ac = site_url+'/taobao/info',
					url = $(this).prev().val()

				$.post(ac,{url:url},function(data){
					var data = $.parseJSON(data);
					var html = '<input type="text" class="span8" value="'+data.item.title+'">'+
								'<img src="'+data.item.pic_url+'">'+
								'<a href="#" class="next-step btn btn-primary">下一步</a>'
					$('#tb-container').html(html)
				})
			}
		}
	})
})