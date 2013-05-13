define(function(require){
	var $ = require('jquery')
	$('#sendAcEmail').click(function(){
		var url = $(this).attr('href'),
			that = $(this)
		$.get(url,function(data){
			if(data=='success'){
				that.html('激活邮件已经发送，请到邮箱查收，如没有收到，点击重新发送')
			}
		})
		return false
	})
})