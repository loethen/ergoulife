define(function(require){
	var $ = require('jquery')
	var util = require('./util')
	require.async('spritely',function(){
		$('#ergou').sprite({fps: 6, no_of_frames: 3})
			.mouseover(function(){
				var w = $('.container').width()-100;
				var ran = util.random(0,w)
				var l = parseInt($(this).css('left'));
				if(ran>l){
					$(this).spState(1)
				}else{
					$(this).spState(2)
				}
				$(this).animate({
					left:ran
				},2000)
			})
	})
})