define(function(require){
	var $ = require('jquery')

	require.async('jcrop',function(){
		$('#avatar').Jcrop({
			setSelect: [0,0,48,48],
			aspectRatio:1,
			onChange:showPreview, 
			onSelect:showPreview
		})	
	})	
	function showPreview(coords){ 
		if(parseInt(coords.w) > 0){
		 var rx = $("#preview_box").width() / coords.w; 
		 var ry = $("#preview_box").height() / coords.h; 
		 $("#crop_preview").css({ 
		 	 width:Math.round(rx * $("#avatar").width()) + "px",
		 	 height:Math.round(rx * $("#avatar").height()) + "px", 
		 	 marginLeft:"-" + Math.round(rx * coords.x) + "px", 
		 	 marginTop:"-" + Math.round(ry * coords.y) + "px" 
		 	}); 
		} 
	}	
})
