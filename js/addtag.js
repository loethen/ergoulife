define(function(require){
	var $ = require('jquery')
	$('#addtag').on('click',function(){
		var tag = $('#tag').val();
		tag = $.trim(tag);
		$.post(site_url+'/tags/addtag',{tag:tag},function(data){
			data = $.parseJSON(data);
			var el = $('<span data-id="data.tag_id">'+data.tag_name+'</span>')
			$('.tags').append(el)
		})
	})
})