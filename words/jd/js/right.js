$(function(){

//	创建一个公用的函数
	function right(){
//	获取当前浏览器高度赋值给右边的大框		
		var height = $(window).height();
		$('#right').css('height',height+'px');
//		获取中间的内容元素
		var middle = $('#right .left .among');
//		获取中间的高度
		var h = middle.height();
//		计算中间内容的top值赋值给它
		var top = (height - h)/2;
		middle.css({
			top:top
		});
	}
	right();
//	当浏览器的窗口发生变化的时候重新获取高度赋值
	$(window).resize(function(){
		right();
	})
	
	
	
	
	

//	右边中间的按钮内容效果
	var t;
//	获取元素
	var large = $('#right .left .among .middle');
	large.mouseenter(function(){
		hd = $(this).attr('hd');
//		alert(hd);
		if(hd==1){
			return;
		}
//		清除定时炸弹
		clearTimeout(t);
//		创建一个定时炸弹
		var this_index = $(this);
		t = setTimeout(function(){
//			给移动的当前DIV增加一个class
			$(this_index).addClass('tj');
//			改变em的left
			$(this_index).find('em').stop().animate({
				left:-58
			},200)
		},200)

	})
//	移除放回原来属性
	large.mouseleave(function(){
		if(hd==1){
			return;
		}
//		清除定时炸弹
		clearTimeout(t);
		$(this).removeClass('tj');
		$(this).find('em').stop().animate({
			left:0
		},200)
		
		
	})
	var yihuiqu = true;
//	点击切换对应的内容
	large.slice(0,5).click(function(){
//		先遍历对象    让hd都变成2
		large.each(function(i){
			large.attr({hd:"2"});
		})
//		点击获取他的序号
		index = $(this).index();

		if(hd==2 && yihuiqu == true){
			$(this).attr({hd:"1"});
//			如果hd=2 且 yihuiqu 为真 让让指定的元素left变成0直接放回不执行下面代码
			$('#right .right .man_1').eq(index).css({
				'left': '0px'
			})
//			做判断是否是移出来如果yichulai是真就执行宽度增加到270像素
			$('#right .right').stop().animate({
				'width': '270px'
			},200,function(){
				yihuiqu=false;
			})
			
		}
//		显示对应的标签
		$('#right .right .man_1').eq(index).css({'z-index':'10','top':'0px'}).stop().animate({'left':'0px',opacity:1},400)
								.siblings('#right .right .man_1').css('z-index','0').stop().animate({'left':'270px','top':'50px',opacity:0},500);
		

//		先切换hd属性
		$(this).attr({hd:"1"});

//		如果hd值为1且yichulai为假就移回去且删除class让hd变回2然后直接放回不执行接下来代码
		if(hd==1 && yihuiqu ==false){
			$(this).removeClass('tj');
			$(this).attr({hd:"2"});
			$('#right .right').stop().animate({
				'width': 0
			},500,function(){
				yihuiqu=true;
			})
			return;
		}
//		记录hd
		hd = $(this).attr('hd');
//		点击增加一个class
		$(this).addClass('tj').attr({hd:"1"})
//				删除兄弟元素的class
				.siblings('.among .middle').removeClass('tj');
//		点击之后把em标签移到原来位置
		$(this).find('em').stop().animate({
			left:0
		},200)
		return false;
		
		
	})
	

	
	var timer;
//	右边下面2个按钮的内容效果
	$('#right .left .bottom .upper').hover(function(){
//		清除定时炸弹
		clearTimeout(timer);
		var this_old = $(this);
//		创建一个定时炸弹
		timer = setTimeout(function(){
//			改变i标签和em标签class
			this_old.addClass('zj');
	//		移动em标签
			this_old.find('em').stop().animate({
				left:-47
			},200)
		},200)

	},function(){
//		清除定时炸弹
		clearTimeout(timer);
//		离开全部调回之前的样式
		$(this).removeClass('zj');
		$(this).find('em').stop().animate({
			left:0
		},200)
	})
//	单击往上的按钮放回顶部
	$('#right .left .bottom .upper').click(function(){
		$('html,body').animate({
			scrollTop:0
		},500,'easeOutExpo')
	})
	
	
	
	
//	方法一:使用失去焦点做
	
//	$('#right').blur(function(){
////		先遍历对象    让hd都变成2     删除所有class  tj
//		large.each(function(i){
//			large.attr({hd:"2"});
//			large.removeClass('tj');
//		})
////		右边的框框转回去
//		$('#right .right').stop().animate({
//			'width': 0
//		},500,function(){
////			动画结束后执行yihuiqu变成真
//			yihuiqu=true;
//		})
//	})

		
//	方法二阻止事件流的同时跳转用js跳
//	$('#right').find('a').click(function(){
//		var href = $(this).attr('href');
//		location.href = href;
//	})

	function run(){
//		先遍历对象    让hd都变成2     删除所有class  tj
		large.each(function(i){
			large.attr({hd:"2"});
			large.removeClass('tj');
		})
//		右边的框框转回去
		$('#right .right').stop().animate({
			'width': 0
		},500,function(){
//			动画结束后执行yihuiqu变成真
			yihuiqu=true;
		})
	}
	
	
//	方法三
	document.addEventListener("click",run);
	
//	阻止右边框内的事件流
	$('#right .right').click(function(e){
		var event = e || window.event;
		event.stopPropagation();
		
	})
	
//	点击其他的地方时候框框回去
//	$(document).click(function(){
////		alert(1);
//		run();
//		
//	})
	
	
	
	
	
	
	
	
	
	
	
	
	
	$('#right .right .man_1 .mt .mc:gt(0)').hide();
//	我的关注
	$('#right .right .man_1 .follow ul li').hover(function(){
		$(this).addClass('active')
				.siblings().removeClass('active');
		
		$('#right .right .man_1 .mt .mc').eq($(this).index()).show()
												.siblings().hide();
		
		
	})
	
//	商品关注特效
	$("#right .right .man_1 .mt .mc .shop ul li").hover(function(){
		$(this).addClass('actibe');
	},function(){
		$(this).removeClass('actibe');
	})
	
	

})
