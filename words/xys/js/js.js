$(function(){
	var c = 0;
	$(".navbar i").click(function(){
		if(c==0){
		    $("nav ul").stop().slideDown("slow");
			c=1;
		}else{
		    $("nav ul").stop().slideUp("slow");
			c=0;
		}
	});
	
	
	
	$(window).resize(function(){
		var width =  $(document).width()
//		document.title = width;
		if(width>650){
			$("nav ul").attr('style','');
			c=0;
		}
	})
	
	
})
