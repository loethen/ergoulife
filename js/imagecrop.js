define(function(require,exports,module){
	var $ = require('jquery')

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
			require.async('jcrop',function(){
				$('#imageCrop').Jcrop({
					setSelect: [0,0,150,120],
					aspectRatio:1.25,
					onChange:showCoords,
	        		onSelect:showCoords
				});	
			})
			
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
			require.async('util',function(util){
				util.tipClose()
			})
		});
	})
})