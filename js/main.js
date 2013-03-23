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
		peopsum==0 ? avg = "<em>(>^ω^<)喵</em>" : avg = twoDecimal(starsum/peopsum)+'星';
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
	/*============
	后台分类管理
	============*/
	$('.cate-table table').on('click','a',function(event){
		var that = event.target;
		that=$(that);
		var id = that.data('id');
		var url = site_url + '/usercenter/delete_cate/'+id;
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
	/*===图片上传，剪裁===*/
	$('.admin_form').submit(function(){
		if($('#path').val()==''){
			tip('你还没上传图片');
			return false;
		}
	})
	$('#inputImage').on('change',function(){
		var url = site_url+'/image/upload';
		var file = document.getElementById('inputImage').files[0];
		tip('正在上传图片图片...');
		uploadFile(url,file,function(data){
			var res = base_url+'uploads/'+data.file_name;
			$('#respos').html("<img id='imageCrop' src='"+res+"'>");
			$('#respos').append("<a href='javascript:;' style='margin-top:10px;' class='btn btn-primary' id='cropit'>确认剪裁</a>")
			$('#imageCrop').Jcrop({
				setSelect: [10,10,150,150],
				aspectRatio:1,
				onChange:showCoords,
        		onSelect:showCoords
			});
			var x,y,w,h;
			$('#cropit').on('click',function(){
				var curl = site_url+'/image/crop';
				var path = './uploads/'+data.file_name;
				var filename = data.file_name;
				$.post(curl,{src:path,fname:filename,x:x,y:y,w:w,h:h},function(response){
					if(response=='success'){
						var src = base_url+'uploads/thumb/'+data.file_name;
						$('#respos').html("<img id='imageThumb' src='"+src+"'>");
						$('#path').val(filename);
					}
				})
				return false;
			})
			function showCoords(c){
				x = c.x;
				y = c.y;
				w = c.w;
				h = c.h;
			}
			tipClose();
		});
	})
	
	/*===================
	工具函数
	===================*/
	function uploadFile(url,file,callback){
		var formData = new FormData();
		if(formData){
			formData.append('imgfile',file);
			var xhr = new XMLHttpRequest();
			xhr.open('POST',url,true);
			xhr.onload = function(e){
				if(this.status == 200){
					var resp = $.parseJSON(this.response);
					callback(resp);
				}else{
					tip('上传失败');
				}
			}
			xhr.send(formData);
		}else{
			tip('浏览器不支持,请使用chrome或者火狐');
		}
	}
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
			tipClose();
		})
	}
	function tipClose(){
		$('#toptip').hide();
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

