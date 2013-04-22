define(function(require){
	var $ = require('jquery')
	$('.reply').click(function(){
		var id = $(this).data('id'),
			name = $(this).data('name'),
			Ta = $('textarea[name=content]'),
			val = Ta.val()
		if(val.indexOf('@')!=-1){
			$('#tiperr').html('每次只能回复给一个人').css('color','red')
			Ta.focus()
			return 
		}else{
			$('#tiperr').html('')
		}
		Ta.val(val+'@'+name+' ').focus()
	})
})