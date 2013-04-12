define(function(require){
	var $ = require('jquery')
	$('ul.tags').on('click','a',function(){
		var id = $(this).parent().data('id'),
			arr = $('#tagsid').val().split(','),
			index = $.inArray(id.toString(),arr)

		if(index!=-1){
			var arr1 = arr.splice(index,1)
			$('#tagsid').val(arr.toString())
		}
		
		$(this).parent().remove();
		return false;
	})
})