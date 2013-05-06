define(function(require){
	var $ = require('jquery')
	$('.rxitems').coffee({
		'click':{
			'.mini-img a':function(){
				var src = $(this).find('img').attr('src')
				if(src.indexOf('w=40')!=-1){
					src = src.replace(/w=40\&h=40/i,'w=400&h=400')
				}else{
					src = src.replace(/40x40/i,'400x400')
				}
				var fg = $(this).closest('.fg')
				var loading = base_url+'img/loading.gif'
				var img = fg.find('.large-img>a>img')
				img.attr('src',loading)
				$('<img>').attr('src',src).load(function(){
					img.attr('src',src)
				})
			}
		}
	})
})