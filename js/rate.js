define(function(require){
	var $ = require('jquery')
	require.async('raty',function(){
		$('.star').raty({
			path: base_url+'img',
			width:120,
			hints:['很差','较差','还行','推荐','力荐'],
			click:function(score,evt){
				$.getJSON(site_url+'/sign/is_login',function(data){
					if(data.is_login){
						var href = window.location.href;
						var arr = href.split('/');
						var id = arr.pop();
						$.post(site_url+'/rate/update_rate',{id:id,score:score},function(data){
							if(!!data){
								require.async('./util',function(util){
									util.tipAutoHide('投票成功!',function(){
										location.href = location.href;
									})
								})
							}else{
								alert(data)
							}
						})
					}else{
						require.async('./util',function(util){
							util.quickSign();
						})
					}
				})
			},
			score:function(){
				return $(this).data('score');
			}
		});
	})
})