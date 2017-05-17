$(function(){
	//移动到某个位置显示搜索框
	var roll = $('#roll_search');
	var roll_bolow = $('#bolow');
	var roll_height = screen.height;
	$(window).scroll(function(){
		var this_scrollTop = $(this).scrollTop();
		var height = $(window).scrollTop();
		if(this_scrollTop>roll_height){
			roll_bolow.show();
			roll.show();
		}else{
			roll_bolow.hide();
			roll.hide();
		}
	})
	
	
	


//	顶部下拉内容效果
	var middle = $('#top .right ul li');
	middle.hover(function(){
		$(this).children('.box').show();
		$(this).find('p').addClass('add');
	},function(){
		$(this).children('.box').hide();
		$(this).find('p').removeClass('add');
	})
	
	
	

	
//	$(this).children('.nav_cat').css({top:-12})
//	导航栏的效果
	var oA = $('#nav .center a');
	oA.hover(function(){
		$(this).children('.nav_cat').stop().animate({top:-12,opacity:1},400)
	},function(){
		$(this).children('.nav_cat').stop().animate({top:0,opacity:0},400)
	})
	
	
	
	
	
	
//	轮播图区域左边导航部分代码
	var aLi = $('.middle .middle_left ul li');
	aLi.hover(function(){
		var oB = $(this).index();
		$(this).children('.box_class').show();
		if(oB==0){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#e54077'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#e54077'})
		}
		if(oB==1 || oB==2 || oB==5 || oB==9 || oB==11){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#427def'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#427def'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#427def'})
		}
		if(oB==3){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#e54077'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#e54077'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#e54077'})
		}
		if(oB==4){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#6347ed'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#6347ed'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#6347ed'})
		}
		if(oB==6 || oB==10 || oB==14){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#fb5c5c'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#fb5c5c'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#fb5c5c'})
		}
		if(oB==7 || oB==8 || oB==12 || oB==15){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#f8a831'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#f8a831'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#f8a831'})
		}
		if(oB==7 || oB==8 || oB==13){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#f8a831'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#f8a831'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#f8a831'})
		}
		if(oB==13 || oB==15){
			$('.middle_left ul li').eq(oB).find('.color').css({fontWeight:700,color:'#3bc7b0'})
			$('.middle_left ul li').eq(oB).find('.color i').css({color:'#3bc7b0'})
			$('.middle_left ul li').eq(oB).find('.color a').css({fontWeight:700,color:'#3bc7b0'})
		}
//		alert(oB);
	},function(){
		$(this).children('.box_class').hide();
		$('.middle_left ul li').find('.color').css({fontWeight:400,color:'#000'})
		$('.middle_left ul li').find('.color i').css({color:'#787d83'})
		$('.middle_left ul li').find('.color a').css({fontWeight:400,color:'#000'})
	})
	
	
	//轮播图的实现
	var index = 0;
	var img = $('#content .lb li');
	var sublim = $('#content .fle li');
	t=null;
	sublim.mouseover(function(){
		index = $(this).index();
		$(this).addClass('active')
				.siblings('li').removeClass('active');
		img.stop();
		img.eq(index).siblings().animate({
			opacity:0
		},1000)
		img.eq(index).animate({
			opacity:1
		},1000)
	})
	function time(){
		index++;
		if(index>5){
			index = 0;
		}
		sublim.eq(index).addClass('active')
				.siblings('li').removeClass('active');
		img.stop();
		img.eq(index).siblings().animate({
			opacity:0
		},1000)
		img.eq(index).animate({
			opacity:1
		},1000)
	}
	t=setInterval(function(){
		time();
	},3000)
	//清除增加定时器
	$('#content').mouseover(function(){
		clearInterval(t);
	})
	$('#content').mouseout(function(){
		t=setInterval(function(){
			time();
		},3000)
	})
	
	
//	热门品牌遮罩层
//	<div class="mask"></div>
//	<span class="follow">关注人数 299.4万</span>
//	<i class="iconfont dle">&#xf0208;</i>
//	<div class="get_into">点击进入</div>遮罩层
	var oLi = $('#hot .hot_middle ul li');
	var move = oLi.length-1;
	oLi.hover(function(){
		//移入
		var number = $(this).index();
		if(number<move){
			$(this).append('<div class="mask"></div><span class="follow">关注人数 299.4万</span><i class="iconfont dle">&#xf0208;</i><div class="get_into">点击进入</div>');
		}else{
			$(this).css({background:'#dd2727'});
			$(this).find('.bg_color').css({color:'#FFFFFF'});
			$(this).find('.change').css({color:'#FFFFFF'});
		}
	},function(){
		//移出
		$('.mask').remove();
		$('.follow').remove();
		$('.get_into').remove();
		$('.dle').remove();
		$(this).css({background:'#FFFFFF'})
		$(this).find('.bg_color').css({color:'#99999c'});
		$(this).find('.change').css({color:'#99999c'});
	})
	
	
	
	
	
//	鼠标放上去图片变大
	var dImg = $('#module ul li a');
	dImg.hover(function(){
		$(this).find('.img_con img').stop().animate({
			width:160,
			height:160,
			top:-10,
			left:-10
		},200);
	},function(){
		$(this).find('.img_con img').stop().animate({
			width:140,
			height:140,
			top:0,
			left:0
		},200);
	})




//	图片区域鼠标移上去移动
//#box .box_middle .large_shop a:hover img{
//	right: 5px;
//}
	var oImg = $('#box .box_middle .large_shop a');
	
	oImg.hover(function(){
		$(this).children('img').stop().animate({right:5},200);
	},function(){
		$(this).children('img').stop().animate({right:0},200);
	})
	
	var aImg = $('#box .box_middle .large_right a');
	aImg.hover(function(){
		$(this).children('img').stop().animate({right:5},200);
	},function(){
		$(this).children('img').stop().animate({right:0},200);
	})
	
	var bImg = $('#box .box_middle .large a');
	bImg.hover(function(){
		$(this).children('img').stop().animate({opacity:0.7},500);
	},function(){
		$(this).children('img').stop().animate({opacity:1},500);
	})
	
//	品牌旗舰店
	var pImg = $('#brand ul li .shop_items .shop_item a');
	var oKj = $('#brand ul li');
	pImg.hover(function(){
		$(this).children('img').stop().animate({opacity:0.7},500);
	},function(){
		$(this).children('img').stop().animate({opacity:1},500);
	})
	oKj.hover(function(){
		$(this).append('<div class="kj"></div>');
	},function(){
		$('.kj').remove();
	})
	
//	猜你喜欢
	var cImg = $('#like ul li a');
	cImg.hover(function(){
		$(this).children('img').stop().animate({opacity:0.7},500);
	},function(){
		$(this).children('img').stop().animate({opacity:1},500);
	})
})
