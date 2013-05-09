define(function(require){
	//bing
	var $ = require('jquery'),
		b = $('.bing-form-search'),
		lock = false
		
	$('#loeTab a').click(function (e) {
  		e.preventDefault();
  		$(this).tab('show');
	})
	/**====  在线搜索  =====**/
	$('#bingkey').val('')

	b.submit(function(){
		$('#bingRes').empty()
 		var query = $('#bingkey').val()
 		if(query&&!lock){
 			lock = true
 			$(this).find('.btn').text('正在搜索...')
 			search(query)
 		}
 		return false;
	})

	$('#bingRes').coffee({
		'click':{
			'a':function(){
				chooseimgs($(this))
				return false
			}
		}
	})
	
	//大小图切换
	var bwrap = $('#bing-wrap')
	bwrap.coffee({
		'click':{
			'.thumb-min a':function(){
				var src = $(this).find('img').attr('src'),
					url = ''
				if(src.indexOf('&')!=-1){
					url = src.replace(/w=40\&h=40/i,'w=310&h=310')
				}else{
					url = src.replace(/_40/i,'_310')
				}
				large = bwrap.find('.thumb-big')
				var loading = base_url+'img/loading.gif'
				large.attr('src',loading)
				$('<img>').attr('src',url).load(function(){
					large.attr('src',url)
				})
			}
		}
	})
	$('#chooseOk').on('click',function(){
		var item = {
				itemimg:[]
			},
			that = $(this)
		if($('#bingRes a.selected,#handRes a.selected').length<=0){
			$('#imgtip').html('您一张图片都没选')
			return false
		}
		$('#bingRes a.selected,#handRes a.selected').each(function(){
			var src = $(this).find('img').attr('src'),
				by = $(this).find('img').attr('class')
			item.itemimg.push({src:src,by:by})
		})

		$('#bingModal').modal('hide')

		$('#bing-wrap').empty()
		$('#bing-tmpl').tmpl(item)
						.appendTo('#bing-wrap')
		var tmparr=[]
		for(var i=0;i<item.itemimg.length;i++){
			tmparr.push(item.itemimg[i].src)
		}
		console.log(tmparr)
		var str = tmparr.join()
		$('#bing-imgs').val(str)
	})
	function search(query){
		$.getJSON(site_url+'/bing/bing_proxy', {query:query}, function(obj){
			if (obj.d !== undefined){
				var items = obj.d.results
				if(items.length==0){
					$('#bingRes').html('抱歉，没有搜到结果，请换个关键字试试，或者选择自己上传图片')
					return
				}
				for (var k = 0, len = items.length; k < len; k++){
					var item = items[k]
					showImageResult(item)
				}
				b.find('.btn').text('重新搜索')
				lock = false
			}			
		})
	}
	function showImageResult(item){
		var a = document.createElement('a');
		a.href = '#';
	// Create an image element and set its source to the thumbnail.

		var i = document.createElement('img');
		i.src = item.Thumbnail.MediaUrl;
		i.className = "frombing"
		i.style.height = '200px';
	// Make the object that the user clicks the thumbnail image.
		$(a).append(i);
	// Append the anchor tag and paragraph with the title to the results div.
		$('#bingRes').append(a);
	}
	function chooseimgs(target){
		var html = $("<i class='icon-ok'></i>")
		var add

		if($('.tab-content a.selected').length>=5){
			$('#imgtip').html('最多选择五张图片')
			add = false
		}else{
			$('#imgtip').html('')
		}

		target.toggleClass('selected',add);

		if(target.hasClass('selected')){
			if(target.find('i').length<=0){
				target.append(html)
			}
		}else{
			if(target.find('i').length>0){
				target.find('i').remove();
			}
		}
	}
	/**=====  手动上传   =====**/
	$('#pdimg').change(function(){
		var elem = $('<span>正在上传...</span>'),
			pdimg = $(this)
		require.async('ajaxform',function(){
			$('.form-pd').ajaxForm({
				dataType:'json',
				beforeSend: function() {
			        $('.w80').append(elem)
			    },
				success:function(data){
					elem.remove()
					pdimg.val('')
					if(!data.state){
			    		alert("上传失败，请重试")
			    		if(typeof data.msg!="undefined"){
			    			alert(data.msg)
			    		}
			    		return false
			    	}
			    	var a = document.createElement('a');
						a.href = '#';
						var i = document.createElement('img');
						i.src = 'http://im007.b0.upaiyun.com/b2c/'+data.filename;
						i.style.height = '200px';
						i.className = 'b2c'
			    	$(a).append(i)
			    	$('#handRes').append(a)
				}
			})
			return false;	
		})
	})
	$('#handRes').coffee({
		'click':{
			'a':function(){
				chooseimgs($(this))
				return false
			}
		}
	})
})