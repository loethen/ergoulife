(function($){
	/*============
	首页hover
	============*/
	$('.brand').hover(function(){
		$(this).find('i').show();
	})
	$(' #da-thumbs > li ').each( function() { 
		$(this).hoverdir(); 
	} );
	/*============
	后台品牌管理
	============*/
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
					autoClose('删除出错，请重试');
				}
				return false;
			})
		}
	})
	/*===================
	品牌详情页 评分计算
	===================*/
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
						console.log(data)
						if(!!data){
							tipAutoHide('投票成功!',function(){
								location.href = location.href;
							});
							
						}else{
							alert(data)
						}
					})
				}else{
					quickSign();
				}
			})
		},
		score:function(){
			return $(this).data('score');
		}
	});
	$('.star img').tooltip();
	
	$(function(){
		var starsum=0, 
			peopsum=0, 
			avg;
		$('.rate-bar').each(function(){
			var em = $(this).find('em');
			starsum += em.data('star')*em.text();
			peopsum += parseInt(em.text());
		})
		peopsum==0 ? avg = "<small>抢沙发！</small>" : avg = twoDecimal(starsum/peopsum)+'星';
		$('#avg').html(avg);

		$('.rate-bar').each(function(){
			var bar = $(this).find('.bar'),
				num = $(this).find('em').text();
			if(peopsum==0){
				bar.width('0');
			}else{
				var w = Math.round(num/peopsum*100);
				bar.width(w+'%');
			}
		})
	})
	$("a[data-toggle=popover]").popover();
	/*===================
		评论
	===================*/
	$('#iwantcomment').click(function(){
		quickSign();
	})
	$('#comment-form').submit(function(){
		if(($('#comment-content').val() == '')){
			$('#comment-content').addClass('error-border');
			return false;
		}
		return true;
	})
	$('.comment-page blockquote').hover(function(){
		$(this).css('background-color','#dfeeff');
	},function(){
		$(this).css('background-color','#fff')
	});


	/*===================
	工具函数
	===================*/
	function quickSign(){
		$.colorbox({
			href:site_url+'/sign/quick_sign',
			data:{cur_url:window.location.href}
		})
	}
	function twoDecimal(str){
		var f_x = parseFloat(str);
		return isNaN(f_x) ? aler('非数字项') : Math.round(f_x*10)/10;
	}
	function tip(msg){
		$('#toptip').find('span').html(msg)
					.end().show();
		$('#tipclose').click(function(){
			$('#toptip').hide();
		})
	}
	function tipAutoHide(msg,cb){
		tip(msg);
		setTimeout(function(){
			$('#toptip').fadeOut(function(){
				cb && cb();
			});
		},1000)
	}

})(window.jQuery)

