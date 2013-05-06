define(function(require){
	//bing
	var $ = require('jquery'),
		b = $('.bing-form-search'),
		lock = false

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
				var html = $("<i class='icon-ok'></i>")
				var add

				if($('#bingRes a.selected').length>=5){
					$('#imgtip').html('最多选择五张图片')
					add = false
				}else{
					$('#imgtip').html('')
				}

				$(this).toggleClass('selected',add);

				if($(this).hasClass('selected')){
					if($(this).find('i').length<=0){
						$(this).append(html)
					}
				}else{
					if($(this).find('i').length>0){
						$(this).find('i').remove();
					}
				}

				return false;
			}
		}
	})
	var bwrap = $('#bing-wrap')
	bwrap.coffee({
		'click':{
			'.thumb-min a':function(){
				var src = $(this).find('img').attr('src'),
				url = src.replace(/w=40\&h=40/i,'w=400&h=400'),
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
		if($('#bingRes a.selected').length<=0){
			$('#imgtip').html('您一张图片都没选')
			return false
		}
		$('#bingRes a.selected').each(function(){
			var src = $(this).find('img').attr('src')
			item.itemimg.push(src)
		})

		$('#bingModal').modal('hide')

		$('#bing-wrap').empty()
		$('#bing-tmpl').tmpl(item)
						.appendTo('#bing-wrap')
		var str = item.itemimg.join()
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
		i.style.height = '200px';
	// Make the object that the user clicks the thumbnail image.
		$(a).append(i);
	// Append the anchor tag and paragraph with the title to the results div.
		$('#bingRes').append(a);
	}
})