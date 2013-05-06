define(function(require){

	var $ = require('jquery'),
		gc = $('.guid-wrap'),
		lock = false

	gc.coffee({
		'click':{
			'#loaditem':function(){
				if(!lock){
					lock = true;
					var ac = site_url+'/taobao/info',
						url = $(this).prev().val(),
						that = $(this)

					if($.trim(url)=='') return false

					$(this).html('正在载入...')	

					$.post(ac,{url:url},function(data){
						var data = $.parseJSON(data) 
						if(typeof data.error != 'undefined' || typeof data.code != 'undefined') {
							$('#tb-container').html(data.error)
						}else{
							$('#tb-container').html('')
							$('#tb-tmpl').tmpl(data)
											.appendTo('#tb-container')
						}
						lock = false;
						that.html('重新载入')
					})	
				}
			}
		}
	})
	var tbc = $('#tb-container')
	tbc.coffee({
		'click':{
			'.thumb-min a':function(){
				var url = $(this).attr('href')
				tbc.find('.thumb-big')
							.attr('src',url)
				return false
			}

		}
	})
	$('#tb-form').submit(function(){
		var arr = [];
		$('.thumb-min a').each(function(){
			var url = $(this).attr('href')
			url = url.replace(/_310x310\.jpg/i,'')
			arr.push(url)
		})
		var itemimgs = arr.join()
		$('#itemimgs').val(itemimgs)

		var val = $('#des').val()
		if($.trim(val)==''){
			$('#des-tip').show();
			return false;
		}
	})
})