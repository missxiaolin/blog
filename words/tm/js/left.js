$(function(){
	$(window).scroll(function(){
		var top = $(window).scrollTop();
//		document.title = top;
		if(top>=705){
			t = setTimeout(function(){
				$('#left').fadeIn();
			},200)
			
		}else{
			clearTimeout(t);
			setTimeout(function(){
				$('#left').fadeOut();
			},200)
			
		}
		if(top>=1690 && top<2170){
			$('#left .one').addClass('l1');
		}else{
			$('#left .one').removeClass('l1');
		}
		if(top>=2170 && top<2730){
			$('#left .two').addClass('l2');
		}else{
			$('#left .two').removeClass('l2');
		}
		if(top>=2730 && top<3185){
			$('#left .three').addClass('l3');
		}else{
			$('#left .three').removeClass('l3');
		}
		if(top>=3185 && top<3755){
			$('#left .four').addClass('l4');
		}else{
			$('#left .four').removeClass('l4');
		}
		if(top>=3755 && top<4222){
			$('#left .five').addClass('l5');
		}else{
			$('#left .five').removeClass('l5');
		}
		if(top>=4222 && top<4765){
			$('#left .six').addClass('l6');
		}else{
			$('#left .six').removeClass('l6');
		}
		if(top>=4765 && top<5560){
			$('#left .seven').addClass('l7');
		}else{
			$('#left .seven').removeClass('l7');
		}
		if(top>=5560){
			$('#left .eight').addClass('l7');
		}else{
			$('#left .eight').removeClass('l7');
		}
	})
	$('#left .one').click(function(){
			$('html,body').animate({
				scrollTop:1690
			},500,'easeOutExpo')
	})
	$('#left .two').click(function(){
			$('html,body').animate({
				scrollTop:2170
			},500,'easeOutExpo')
	})
	$('#left .three').click(function(){
			$('html,body').animate({
				scrollTop:2730
			},500,'easeOutExpo')
	})
	$('#left .four').click(function(){
			$('html,body').animate({
				scrollTop:3185
			},500,'easeOutExpo')
	})
	$('#left .five').click(function(){
			$('html,body').animate({
				scrollTop:3755
			},500,'easeOutExpo')
	})
	$('#left .six').click(function(){
			$('html,body').animate({
				scrollTop:4222
			},500,'easeOutExpo')
	})
	$('#left .seven').click(function(){
			$('html,body').animate({
				scrollTop:4765
			},500,'easeOutExpo')
	})
	$('#left .eight').click(function(){
			$('html,body').animate({
				scrollTop:5560
			},500,'easeOutExpo')
	})
	$('#left .last').click(function(){
		$('html,body').animate({
			scrollTop:0
		},500,'easeOutExpo')
	})
	$('#right .back').click(function(){
		$('html,body').animate({
			scrollTop:0
		},500,'easeOutExpo')
	})
})
