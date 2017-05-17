$(function(){
	
//	获取图片改变
	var img = $('.box .min_pic img');
//	鼠标移入改变图片位置
	img.mouseover(function(){
//		获取小图改变小图位置
		var min_img = $(this).attr('src');
		$('.box .pic_img img').attr('src',min_img);
//		获取大图改变大图位置
		var max_img = $(this).attr('_bigsrc');
		$('.box .large img').attr('src',max_img);
	})
	
//	改变色块和图片位置
	$('.box .pic_img .cover').mousemove(function(e){
//		移入显示b标签和放大DIV
		$('.box .pic_img b').show();
		$('.box .large').show();
//		获取鼠标离左边和div离左边的距离算出left值
		var l = e.pageX;
		var L = $(this).offset().left;
		var left = l - L - 100;
//		获取鼠标离顶部和div离顶部的距离算出top值
		var T = e.pageY;
		var t = $(this).offset().top;
		var top = T - t - 100;
//		做判断
		left = left < 0 ? 0 : left;
		left = left > 200 ? 200 : left;
		top = top < 0 ? 0 : top;
		top = top > 200 ? 200 : top;
//		把算出来的值赋值给色块
		$('.box .pic_img b').css({left : left,top : top});
//		计算放大的图片位置
		var imgLeft = -left * 2;
		var imgTop = -top * 2;
//		给放大的图片位置做判断
		imgLeft = imgLeft < -400 ? -400 : imgLeft;
		imgTop = imgTop < -400 ? -400 : imgTop;
		$('.box .large img').css({left : imgLeft, top : imgTop});
	})
	
//	鼠标移入显示隐藏
	$('.box .pic_img .cover').mouseout(function(){
//		移除隐藏
		$('.box .pic_img b').hide();
		$('.box .large').hide();
	})
	
	
	
	
	
//	选择颜色
	
	var xImg = $('.dd .within .pic_img');
	xImg.click(function(){
//		点击切换函数1函数2
		
//		获取小图改变小图位置
		var min_img = $(this).find('img').attr('src');
		$('.box .pic_img img').attr('src',min_img);
//		获取大图改变大图位置
		var max_img = $(this).find('img').attr('_bigsrc');
		$('.box .large img').attr('src',max_img);
		
		$(this).addClass('pic_img_zj')
				.siblings('.pic_img').removeClass('pic_img_zj');
	})
	
//	官方标配
	var gf_box = $('.dd .tc .tc_box')
	gf_box.click(function(){
		$(this).addClass('tc_box_h')
				.siblings('.tc_box').removeClass('tc_box_h');
	})
	
	
	
	

//	获取text框      加     减元素
	var input = $('.dd .number input');
	var add = $('.number .add .jia');
	var reduce = $('.number .add .jian');
//	数量		要点：获取过来是字符串先转换数值
	var sum = parseInt(input.val());
//	单击加号
	add.click(function(){
		sum = sum + 1;
		if(sum>=999){
			sum=999;
		}
		input.val(sum);
	})
//	单击减号
	reduce.click(function(){
		sum = sum - 1;
		if(sum<=1){
			sum=1;
		}
		input.val(sum);
	})
//	当文本框失去焦点重新获取sum的值
	input.blur(function(){
		sum = parseInt(input.val());
	})
//	当文本框改变val值得时候的时候触发以下代码
	input.keyup(function(){
//		做一个正则表达式如果写入除数组以外的字符全部删除    然后给文本框赋值
		var re = /\D/g;
		var str = input.val();
		var r = str.replace(re,'');
		input.val(r);
//		如果是空返回一个值1
		if(input.val()==''){
			input.val(1);
		}
	})
	
	
	
	
	
//	详情页左边加入购物车和手机专享
	$('.right_top .m2 .nav_inner').hover(function(){
		$('.right_top .m2 .nav_inner .shop').show();
	},function(){
		$('.right_top .m2 .nav_inner .shop').hide();
	})
	$('.right_top .m2 .inner').hover(function(){
		$(this).find('a').addClass('cure');
		$(this).find('.shop_phone').show();
	},function(){
		$(this).find('a').removeClass('cure');
		$(this).find('.shop_phone').hide();
	})
	
//	详情页下拉块右边下拉块
	var oLi = $('.right_top .m1 li')
	oLi.click(function(){
		$(this).addClass('cuur')
				.siblings('li').removeClass('cuur');
		$('.right_middle .mc').eq($(this).index()).show()
								.siblings('.mc').hide();
		$('html,body').stop().animate({
			scrollTop:right_top-10
		},500,'easeOutExpo')
	})
	
	var right_down = $('#w .right .box_right');
	var right_top = right_down.offset().top;
	
	
//	详情页下拉块左边
	var down = $('#w .left .store');
	var top = down.offset().top;
//	滚动时间
	$(window).scroll(function(){
		var left_top = $(window).scrollTop();
//		document.title = left_top;
//		如果等于大于他的位置的时候改变
		if(left_top>=top){
//			左边栏目
			$('.store .stotr_shop').hide();
			down.css({
				'position':'fixed',
				'top':0,
				'z-index':200
			});
//			左边栏目移上去显示内容    移除隐藏
			down.hover(function(){
				$('.store .stotr_shop').show();
			},function(){
				$('.store .stotr_shop').hide();
			})
		}else{
//			左边栏目
			$('.store .stotr_shop').show();
			down.css({
				'position':'relative',
				'top':0,
				'z-index':200
			});
			down.hover(function(){
				$('.store .stotr_shop').show();
			},function(){
				$('.store .stotr_shop').show();
			})
		}
		
		
		
//		右边栏目
		if(left_top>=right_top){
			right_down.css({
				'position':'fixed',
				'top':0,
				'z-index':200
			});
		}else{
			right_down.css({
				'position':'relative',
				'top':0,
				'z-index':200
			});
		}







	})
	
	
})
