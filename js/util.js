define(function(require,exports,module){
	var $ = require('jquery')
	module.exports={
		uploadFile: function(url,file,callback){
			var formData = new FormData();
			if(formData){
				formData.append('imgfile',file);
				var xhr = new XMLHttpRequest();
				xhr.open('POST',url,true);
				xhr.onload = function(e){
					if(this.status == 200){
						var resp = $.parseJSON(this.response);
						callback(resp);
					}else{
						tip('上传失败');
					}
				}
				xhr.send(formData);
			}else{
				tip('浏览器不支持,请使用chrome或者火狐');
			}
		},
		quickSign: function (){
			require.async('colorbox',function(){
				$.colorbox({
					href:site_url+'/sign/quick_sign',
					data:{cur_url:window.location.href}
				})
			})
			
		},
		random: function (min,max){
			return Math.floor(Math.random()*(max-min+1)+min);
		},
		twoDecimal: function (str){
			var f_x = parseFloat(str);
			return isNaN(f_x) ? aler('非数字项') : Math.round(f_x*10)/10;
		},
		tip: function (msg){
			$('#toptip').find('span').html(msg)
						.end().show();
			$('#tipclose').click(function(){
				this.tipClose();
			})
		},
		tipClose: function (){
			$('#toptip').hide();
		},
		tipAutoHide: function (msg,cb){
			this.tip(msg);
			setTimeout(function(){
				$('#toptip').fadeOut(function(){
					cb && cb();
				});
			},1000)
		}
	}
})