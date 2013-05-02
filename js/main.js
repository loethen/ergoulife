define(function(require){
	var router = require('./router.js')
	var r = new router()
	var $ = require('jquery')
	require('bootstrap')
	require('./mouse')
	
	var util = require('./util')
	$('a[data-toggle=tooltip]').tooltip()

	//首页
	r.route(/(ergoulife|index\.php|home)(\/)*$/g,function(){
		require('./comment')
		require('./sinashare')
		require('./imgtab')
	})

	//商品详情页
	r.route(/subject/g,function(){
		//vote 
		// require('./rate')
		// require('./rate-caculate')

		// $('.star img').tooltip()
	
		// $("a[data-toggle=popover]").popover()

		require('./imgtab')
		require('./reply')
	})

	//所有品牌页
	r.route(/allbrand/g,function(){
		$('#allbrand .accordion-group').hover(function(){
			$(this).toggleClass('border-red')
		})
	})

	//品牌详情页
	r.route(/brand\/\d+/g,function(){
		require('./subscribe');
	})

	//商品添加页
	r.route(/creat/g,function(){
		require('tmpl')
		require('./create.js')
	})
	//登录注册验证
	r.route(/sign/g,function(){
		
	})

	//用户中心
	r.route(/setting/g,function(){
		require('./avatar')
	})

	//管理员
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

})
