define(function(require){
	var $ = require('jquery')
	var util = require('./util')

	$(function(){
		var starsum=0, 
			peopsum=0, 
			avg;
		$('.rate-bar').each(function(){
			var em = $(this).find('em');
			starsum += em.data('star')*em.text();
			peopsum += parseInt(em.text());
		})
		peopsum==0 ? avg = "<em>(>^ω^<)喵</em>" : avg = util.twoDecimal(starsum/peopsum)+'星';
		$('#avg').html(avg);

		$('.rate-bar').each(function(){
			var bar = $(this).find('.bar'),
				num = $(this).find('em').text();
			if(peopsum==0){
				bar.width('0');
			}else{
				var w = Math.round(num/peopsum*100);
				bar.width(w+'%');
			}
		})
	})
})