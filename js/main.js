(function($){
	/*============
	首页hover
	============*/
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
					alert('删除出错，请重试');
				}
				return false;
			})
		}
	})
	/*============
	品牌详情页
	============*/
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
						if(!!data){
							alert('投票成功');
						}else{
							alert(data)
						}
					})
				}else{
					$.colorbox({
						href:site_url+'/sign/quick_sign',
						data:{cur_url:window.location.href}
					})
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
				bar.width(0);
			}else{
				var w = Math.round(num/peopsum*100);
				bar.width(w+'%');
			}
		})
	})
		

	function twoDecimal(str){
		var f_x = parseFloat(str);
		return isNaN(f_x) ? aler('非数字项') : Math.round(f_x*10)/10;
	}
})(window.jQuery)

