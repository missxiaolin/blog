$(function(){
//	头部鼠标移入显示
	$('.top_right').mouseover(function(){
		$(this).addClass('active');
		var a = $(this).index();
		$('.vancel').eq(a).show();
		$('.top_right #me').eq(a).css({
			color:'#a10000'
		})
	})
//	头部鼠标移除隐藏
	$('.top_right').mouseleave(function(){
		var a = $(this).index();
		$(this).removeClass('active');
		$('.vancel').eq(a).hide();
		$('.top_right #me').eq(a).css({
			color:'#808080'
		})
	})
	
//	移到微信二维码的出现隐藏
	$('.payattention .wechat').mouseover(function(){
		$('.payattention .code').show();
	})
	$('.payattention .wechat').mouseleave(function(){
		$('.payattention .code').hide();
	})
//	购物车效果的制作
	$('.val_left .shop').mouseover(function(){
		$('.val_left .shop a').addClass('shop_active');
		$('.val_left .ware').show();
	})
	$('.val_left .shop').mouseleave(function(){
		$('.val_left .shop a').removeClass('shop_active');
		$('.val_left .ware').hide();
	})
	
//	轮播图的制作
	
	var index = 0;
	var oLi = $('.figure_middle .img a');
	var sulim = $('.slideFooter li');
	var t=null;
//	轮播图公用的函数
	function time(){
		index++;
		if(index > oLi.length-1){
			index = 0;
		}
		sulim.eq(index).addClass('lbactive')
				.siblings('li').removeClass('lbactive');
		oLi.stop();
		oLi.eq(index).siblings().animate({
			opacity:0
		},1000)
		oLi.eq(index).animate({
			opacity:1
		},1000)
//		渐隐效果
//		oLi.eq(index).fadeIn(1000)
//					.siblings('a').fadeOut(1000);
	}
//	按钮放上去实现图片的切换
	sulim.mouseenter(function(){
		index = $(this).index();
		$(this).addClass('lbactive')
				.siblings('li').removeClass('lbactive');
				
		oLi.stop();
		oLi.eq(index).siblings().animate({
			opacity:0
		},1000)
		oLi.eq(index).animate({
			opacity:1
		},1000)
//		渐隐效果
//		oLi.eq(index).fadeIn(1000)
//					.siblings('a').fadeOut(1000);
	})
	
	t=setInterval(function(){
		time();
	},3000)
	//鼠标移入的定时器的清除离开启动定时器
	$('.figure_middle').mouseover(function(){
			clearInterval(t);
	})
	$('.figure_middle').mouseout(function(){
		t=setInterval(function(){
			time();
		},3000)
	})
	
	
	//导航栏下拉的制作
	var bLi = $('#nav .dh li');
	bLi.hover(function(){
		$(this).children('.product').show();
	},function(){
		$(this).children('.product').hide();
	})
	
})
