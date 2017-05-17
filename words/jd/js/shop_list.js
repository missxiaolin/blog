$(function(){
	
//	全部商品菜单栏

//	获取大框div
	var oDiv = $('#nav .center .dh .shop_title');
//	获取大框离顶部的距离
	var oTop = oDiv.offset().top;
//	alert(oTop);
//	获取li
	var left_cd = $('#nav .center .dh .shop_title ul li');
//	移到LI上显示隐藏
	function yl(){
		left_cd.hover(function(){
//			移入显示对应的DIV
			$(this).children('.box').show();
			$(this).children('.box').css({
				top: 0
			})
		},function(){
//			移开隐藏
			$(this).children('.box').hide();
		})
	}
	yl();
	$(window).scroll(function(){
		var top = $(window).scrollTop();
//		document.title = top;
//		当大于大框的时候改变内容的值
		if(top>oTop){
			left_cd.hover(function(){
//				当前的显示
				$(this).children('.box').show();
				$(this).children('.box').css({
					top: top-oTop
				})
			},function(){
//				否者隐藏
				$(this).children('.box').hide();
			})
		}else{
//			否者top值不变
			yl();
		}
	})
	
	
	
	
//	进入商品列表页先隐藏分类
	$('#nav .center .dh .shop_list').hide();
	
	
	
	
//	移入显示全部商品列表移开隐藏
	$('#nav .center .dh').hover(function(){
		$('#nav .center .dh .shop_list').show();
	},function(){
		$('#nav .center .dh .shop_list').hide();
	})
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//	筛选区域
//	获取A-W li
	var screen = $('.sl_wrap .middle .sx li');
//	计算统计的Li的个数
	var sum = screen.length;
//	移入筛选隐藏
	screen.mouseover(function(){
//		先给自身增加改变样式
		$(this).addClass('add_color')
				.siblings('li').removeClass('add_color');
//		先获取身上的值做判断用
		yc = $(this).attr('data_initial');
//		如果选中全部品牌都显示
		if(yc==0){
			$("li[data_initial]").show();
		}else{
			$("li[data_initial]").slice(sum).hide();
			$("li[data_initial="+yc+"]").show();
		}
	})
	
	
//	筛选区域更多单击
	var add = $('#J_selector .sl_wrap .middle .add');
	add.click(function(){
//		单击的时候先判断作用在他自己身上的hd的值
		if($(this).attr('hd')==2){
//			第一次单击
			$(this).parent('.middle').parents('.sl_wrap').attr({'id':'add_sl_wrap'});
			$(this).attr({hd:"1"});
			$(this).find('span').html('收起');
		}else if($(this).attr('hd')==1){
//			第二次单击
			$(this).parent('.middle').parents('.sl_wrap').attr({'id':''});
			$("li[data_initial").show();
			$(this).find('span').html('更多');
			$(this).attr({hd:"2"});
		}
		
	})
	
//	多选代码
	var dx = $('#J_selector .sl_wrap .middle .dx');
	dx.click(function(){
		$(this).parent('.middle').parents('.sl_wrap').attr({'id':'add_sle'});
		$(this).next('.add').attr({hd:"2"});
//		多选的时候改变A标签回到最初更多的内容
		$(this).next('.add').find('span').html('更多');
//		删除筛选身上的class
		$('#J_selector #add_sle .middle .pp ul li a i').removeClass('add_i');
	})
	var qx = $('#J_selector .sl_wrap .middle .sl_btns .qx');
	qx.click(function(){
		$('#J_selector .sl_wrap').attr({'id':''});
		$("li[data_initial]").show();
	})
//	里面选项是否选中代码
	var A = $('#J_selector .sl_wrap .middle .pp ul li a');
//	制作两个函数让i标签可以变化
	function fn1(){
		$(this).find('i').addClass('add_i');
	}
	function fn2(){
		$(this).find('i').removeClass('add_i');
	}
	A.toggle(fn1,fn2);
	
	
})
