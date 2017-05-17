$(function(){
	var height = $(window).height();
	var oRight = $('#right');
	oRight.css({height:height});
	var oK = $('#right .middle').height();
	var dle = (height-oK)/2;
	$('#right .middle').css({top:dle});
	
//	当浏览器窗口发生变化的时候高度改变
	$(window).resize(function() {
		var hei = $(window).height();
		var hle = (hei-oK)/2;
		oRight.css({height:hei});
		$('#right .middle').css({top:hle});
	})
	
	
//	右边导航栏移上去出现天猫APP图片
	$('#right .shop_app').hover(function(){
		$('#right .shop_app .pic').show();
	},function(){
		$('#right .shop_app .pic').hide();
	})
	
//	购物车部分
	$('#right .shop_cat').hover(function(){
		$('#right .shop_cat').addClass('shop_cat_change');
	},function(){
		$('#right .shop_cat').removeClass('shop_cat_change');
	})
	
	
	
	$(window).scroll(function(){
		var roll_top = $(window).scrollTop();
//		document.title = roll_top;
		if(roll_top>height){
			$('#right .back').css({visibility:'visible'});
		}else{
			$('#right .back').css({visibility:'hidden'});
		}
		
	})
})
