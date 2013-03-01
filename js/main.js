require(['jquery','vendor/bootstrap.min','vendor/jquery.hoverdir'],function($){
	$(function(){
		$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );
	})
})