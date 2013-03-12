(function($){
	$(' #da-thumbs > li ').each( function() { 
		$(this).hoverdir(); 
	} );

	$('.manage-table table').on('click','a',function(event){
		var that = event.target;
		that=$(that);
		var id = that.data('id');
		var url = site_url + '/usercenter/delete_brand/'+id;
		if(confirm('确定删除吗？')){
			$.get(url,function(data){
				if(data=='success'){
					that.parent().parent().remove();
				}else{
					alert('删除出错，请重试');
				}
				return false;
			})
		}
	})

	$('.star').raty({
		path: base_url+'img',
		hints:['很差','较差','还行','推荐','力荐'],
		click:function(score,evt){
			$.getJSON(site_url+'/sign/is_login',function(data){
				if(data.is_login){
					var href = window.location.href;
					var arr = href.split('/');
					var id = arr.pop();
					$.post(site_url+'/rate/update_rate',{id:id,score:score},function(data){
						console.log(data)
						if(!!data){
							alert('投票成功');
						}else{
							alert(data)
						}
					})
				}else{
					$.colorbox({
						href:site_url+'/sign/quick_sign',
						width:'400px',
						data:{cur_url:window.location.href}
					})
				}
			})
		}
	});
	$('.star img').tooltip();
})(window.jQuery)