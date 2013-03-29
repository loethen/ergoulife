define(function(require,exports,module){
	function router(){
		this.url = location.href;
	}
	router.prototype.route=function(reg,callback){
		if(reg.test(this.url)){
			callback();
		}
	}
	module.exports = router; 
})