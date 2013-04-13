define(function(require){
	var $ = require('jquery')
	$('#addtag').on('click',function(){
		var tag = $('#tag').val();
		tag = $.trim(tag);
		if(tag=='') return

		$.post(site_url+'/tags/addtag',{tag:tag},function(data){
			data = $.parseJSON(data)
			var t = $('#tagsid').val()
			if(t.indexOf(data.tag_id)!='-1'){
				$('#tag').val('')
				return false;
			}
			var el = $('<li data-id="'+data.tag_id+'"><div>'+data.tag_name+'</div><a class="tagclose" href="#">x</a></li>')
			$('.tags').append(el)
			$('#tag').val('')
			if($('#tagsid').val()=='')
				$('#tagsid').val(data.tag_id)
			else
				$('#tagsid').val($('#tagsid').val()+','+data.tag_id)
		})
	})
})