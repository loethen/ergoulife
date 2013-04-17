define(function(require){
	var $ = require('jquery')
	$('.item').on('click','.comment',function(){

		var item = $(this).closest('.item'),
			pid = item.data('postid'),
			commentlist = item.find('.comment-list'),
			comments = item.find('.comments')
		if(comments.is(':hidden')){
			$.post(site_url+'/comments/show_comment',{pid:pid},function(data){
				data = $.parseJSON(data)
				if(!data){
					commentlist.html("<li><p>还没有人评论</p></li>")
				}else{
					commentlist.html('');
					for(var i=0;i<data.length;i++){
						var obj = data[i],
							str = '<a class="pull-left" href="#"><img width="20px" class="media-object" src="'+base_url+'/uploads/avatar/'+obj.avatar+'"></a><div class="media-body"><p>'+obj.content+'</p></div>';
						$("<li/>").attr('class','media').html(str).appendTo(commentlist)
					}
				}
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
						$.post(site_url+'/comments/show_comment',{pid:pid},function(data){
							data = $.parseJSON(data)
							if(!data){
								commentlist.html("<li><p>评论失败</p></li>")
							}else{
								commentlist.html('');
								for(var i=0;i<data.length;i++){
									var obj = data[i],
										str = '<a class="pull-left" href="#"><img width="20px" class="media-object" src="'+base_url+'/uploads/avatar/'+obj.avatar+'"></a><div class="media-body"><p>'+obj.content+'</p></div>';
									$("<li/>").attr('class','media').html(str).appendTo(commentlist)
								}
							}
						})
					})
			}
	})
})