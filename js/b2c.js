define(function(require){
	//bing
	var $ = require('jquery'),
		b = $('.bing-form-search')

	$('#bingkey').val('')

	b.submit(function(){
		$('#bingRes').empty()
 		var query = $('#bingkey').val()
 		if(query){
 			$(this).find('.btn').text('正在搜索...')
 			search(query)
 		}else{
 			$('#bingRes').html('请输入搜索关键字')
 		}
 		return false;
	})

	$('#bingRes').coffee({
		'click':{
			'a':function(){
				var html = $("<i class='icon-ok'></i>")
				var add
				if($('#bingRes a.selected').length>=3){
					$('#imgtip').html('最多选择三张图片')
					add = false
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


			}
		}
	})
	function search(query){
		$.getJSON(site_url+'/bing/bing_proxy', {query:query}, function(obj){
			console.log(obj)
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
			}			
		})
	}
	function showImageResult(item){
		var a = document.createElement('a');
		a.href = '#';
	// Create an image element and set its source to the thumbnail.

		var i = document.createElement('img');
		i.src = item.Thumbnail.MediaUrl;
		i.width = '150';
	// Make the object that the user clicks the thumbnail image.
		$(a).append(i);
	// Append the anchor tag and paragraph with the title to the results div.
		$('#bingRes').append(a);
	}
})