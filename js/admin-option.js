define(function(require){
	var $ = require('jquery')
	/*============
	后台品牌管理
	============*/
	$('.manage-table table').on('click','a',function(event){
		var that = event.target;
		that=$(that);
		var id = that.data('id');
		var url = site_url + '/admin/delete_brand/'+id;
		if(confirm('确定删除吗？')){
			$.get(url,function(data){
				if(data=='success'){
					that.parent().parent().remove();
				}else{
					autoClose('删除出错，请重试');
				}
				return false;
			})
		}
	})
	/*============
	后台分类管理
	============*/
	$('.cate-table table').on('click','a',function(event){
		var that = event.target;
		that=$(that);
		var id = that.data('id');
		var url = site_url + '/admin/delete_cate/'+id;
		if(confirm('确定删除吗？')){
			$.get(url,function(data){
				if(data=='success'){
					that.parent().parent().remove();
				}else{
					autoClose('删除出错，请重试');
				} 
				return false;
			})
		}
	})
})