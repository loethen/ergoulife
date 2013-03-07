(function($){
	$(' #da-thumbs > li ').each( function() { 
		$(this).hoverdir(); 
	} );

	$('.manage-table table').on('click','a',function(event){
		var that = event.target;
		that=$(that);
		var id = that.data('id');
		var url = $site_url + '/usercenter/delete_brand/'+id;
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

})(window.jQuery)