define(function(require){
	var $ = require('jquery')

	$('#focus').click(function(){
		var f = require('./favorite-effect'),
			flag= $(this).data('flag'),
			id= $("#brand-head").data('id'),
			that = $(this)
		$.getJSON(site_url+'/sign/is_login',function(data){
			if(data.is_login){
				$.post(site_url+'/brand/subscribe',{flag:flag,id:id},function(res){
					if(flag=='focus'){
						if(res){
							$('#focus').html('已关注')
							$('#focus').data('flag','unfocus')
							f.move();
						}
					}else{
						if(res){
							$('#focus').html('关注品牌')
							$('#focus').data('flag','focus')
						}
					}
				})		
			}else{
				require.async('./util',function(util){
					util.quickSign()
				})
			}
		})
	})
})