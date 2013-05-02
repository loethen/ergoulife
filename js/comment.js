define(function(require){
	var $ = require('jquery')
	$('.item').on('click','.comment',function(){

		var item = $(this).closest('.item'),
			pid = item.data('postid'),
			commentlist = item.find('.comment-list'),
			comments = item.find('.comments')
		if(comments.is(':hidden')){
			get_comment(pid,commentlist,function(){
				comments.slideDown();
			})
		}else{
			comments.slideUp();
		}
	})
	$('.item').on('click','.do-comment',function(){
			var item = $(this).closest('.item'),
			pid = item.data('postid'),
			commentlist = item.find('.comment-list'),
			comments = item.find('.comments'),
			c = $(this).prev(),
			replyid = null

			if($.trim(c.val())==''){
				return
			}else{
				cv = c.val();
				$.post(site_url+'/comments/do_comment',{ pid:pid , content:cv , replyid:replyid },
					function(){
						c.val('');
						get_comment(pid,commentlist);
					})
			}
	})

	function get_comment(pid,commentlist,cb){
		$.post(site_url+'/comments/show_comment',{pid:pid},function(data){
			data = $.parseJSON(data)
			if(!data){
				commentlist.html("<li><p>快来发表第一条评论！</p></li>")
			}else{
				commentlist.html('');
				for(var i=0;i<data.length;i++){
					var obj = data[i],
						str = '<a class="pull-left" href="#"><img width="34px" class="media-object img-rounded" src="'+base_url+'/uploads/avatar/'+obj.avatar+'"></a><div class="media-body"><h4 class="media-heading">'+obj.name+'  '+obj.created+'</h4><p>'+obj.content+'</p></div>';
					$("<li/>").attr('class','media').html(str).appendTo(commentlist)
				}
			}
			cb && cb();
		})
	}
})