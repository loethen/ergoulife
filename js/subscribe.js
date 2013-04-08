define(function(require){
	var $ = require('jquery')
	var f = require('./favorite-effect')
	$('#focus').click(function(){
		var flag= $(this).data('flag')
		var id= $("#brand-head").data('id')
		var that = $(this)
		$.getJSON(site_url+'/sign/is_login',function(data){
			if(data.is_login){
				$.post(site_url+'/brand/subscribe',{flag:flag,id:id},function(res){
					if(flag=='focus'){
						if(res){
							$('#focus').html('取消关注')
							$('#focus').data('flag','unfocus')
							f.move();
						}
					}else{
						if(res){
							$('#focus').html('关注')
							$('#focus').data('flag','focus')
						}
					}
				})		
			}else{
				require.async('./util',function(util){
					util.quickSign();
				})
			}
		})
	})
})