define(function(require){
	var $ = require('jquery')
	$('.share').each(function(){
		var item = $(this).closest('.item'),
		title = encodeURIComponent(item.find('h1 a').text()),
		url = item.find('h1 a').attr('href'),
		url = encodeURIComponent(url),
		img = item.find('img:first').attr('src');
		$(this).click(function(){
			uri = 'http://service.weibo.com/share/share.php?url='+url+'&title='+title+'&pic='+img+'&language=zh_cn';
			window.open(uri,'_blank');
		})
	})
})