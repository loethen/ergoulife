define(function(require){
	var router = require('./router.js')
	var r = new router()
	var $ = require('jquery')
	require('bootstrap')
	require('./mouse')
	
	var util = require('./util')

	r.route(/(ergoulife|index\.php|home)(\/)*$/g,function(){
		require.async('hoverdir',function(){
			$(' #da-thumbs > li ').each( function() { 
				$(this).hoverdir(); 
			});
		})
	})

	r.route(/subject/g,function(){
		//vote 
		require('./rate')
		require('./rate-caculate')

		$('.star img').tooltip();
	
		$("a[data-toggle=popover]").popover();

		/*===================
			评论
		===================*/
		$('#iwantcomment').click(function(){
			require.async('./util',function(util){
				util.quickSign();
			})
			
		})
		$('#comment-form').submit(function(){
			if(($('#comment-content').val() == '')){
				$('#comment-content').addClass('error-border');
				return false;
			}
			return true;
		})
		$('.comment-page blockquote').hover(function(){
			$(this).css('background-color','#dfeeff');
		},function(){
			$(this).css('background-color','#fff')
		});
	})

	r.route(/allbrand/g,function(){
		$('#allbrand .accordion-group').hover(function(){
			$(this).toggleClass('border-red')
		})
	})
	r.route(/brand\/\d+/g,function(){
		require('./subscribe');
	})
	r.route(/admin/g,function(){
		require('./imagecrop')
		require('./admin-option')
	})
	r.route(/admin\/product_page/g,function(){
		require.async('../ueditor/editor_config',function(){
			var UE = require('./uedit')
			UE.getEditor('inputDes',{
				initialFrameWidth:700
			})
		})
		require('./addtag')
		require('./rmtag')
	})

	r.route(/sign/g,function(){
		
	})
	
	r.route(/setting/g,function(){
		require('./avatar')
	})
})
