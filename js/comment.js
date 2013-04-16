define(function(require){
	var $ = require('jquery')
	$('.item').on('click','.comment',function(){
		$(this).closest('.item').find('.comments').toggle()
	})
	$('.item').on('click','.do-comment',function(){
		var pid = $(this).closest('.item').data('postid'),
			c = $(this).prev(),
			replyid = null;
			if($.trim(c.val())==''){
				return
			}else{
				cv = c.val();
				// if(c.data('replyid')!==null){
				// 	replyid = c.data('replyid')
				// }
				// console.log(pid,cv,replyid)
				$.post(site_url+'/comments/do_comment',{ pid:pid , content:cv , replyid:replyid },
					function(data){
						console.log(data)
					})
			}
	})
})