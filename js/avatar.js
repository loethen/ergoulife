define(function(require,exports){
	var $ = require('jquery')
	require('ajaxform')

	var bar = $('.bar'),
		progress = $('.progress')
	$('#avatar').change(function(){
		$('.filename').html($(this).val());
	})
	$('.form-avatar').ajaxForm({
		dataType:'json',
	    beforeSend: function() {
	        var percentVal = '0%';
	        bar.width(percentVal)
	    },
	    uploadProgress: function(event, position, total, percentComplete) {
	    	progress.css('visibility','visible')
	        var percentVal = percentComplete + '%'
	        bar.width(percentVal)
	    },
	    success: function(data) {
	    	if(!data.state){
	    		progress.css('visibility','hidden')
	    		bar.width(0);
	    		alert('上传失败，请重试')
	    		return false
	    	}
	    	progress.css('visibility','hidden')
	    	$('.img-avatar').attr('src',base_url+'/uploads/avatar/'+data.filename)
	    	$.post(site_url+'/setting/user_avatar',{filename:data.filename},function(res){
	    		res = $.parseJSON(res)
	    		if(res.state){
	    			require.async('./util',function(util){
	    				util.tipAutoHide('头像设置成功')
	    			})
	    		}
	    	})
	    }
	})
})