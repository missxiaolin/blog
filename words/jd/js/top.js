$(function(){
//	顶部地区区域

//	获取外面大边框和里面的内容
	var tick = $('#top .top_middle .top_left');
	var oA = $('#top .top_middle .top_left .left_box a');
	var oSpan = $('#top .top_middle .top_left .region span');
//	移入大边框显示隐藏的DIV
	tick.mouseover(function(){
		$('#top .top_middle .top_left .region').addClass('zj');
		$('#top .top_middle .top_left .left_box').show();
//		单击A标签的时候删除span的内容增加A标签的内容
		oA.click(function(){
			oA.removeClass('tick');
			$(this).addClass('tick');
			var ble = $(this).html();
//			oSpan.empty();
			oSpan.html(ble);
			$('#top .top_middle .top_left .left_box').hide();
		})
	})
	tick.mouseout(function(){
		$('#top .top_middle .top_left .region').removeClass('zj');
		$('#top .top_middle .top_left .left_box').hide();
	})
	
//	顶部右侧下拉
	var dLi = $('#top .top_middle .top_right ul li');
	dLi.hover(function(){
		$(this).find('.gb').addClass('zj');
		$(this).children('.box').show();
	},function(){
		$(this).find('.gb').removeClass('zj');
		$(this).children('.box').hide();
	})
	
	
	
	
	
	
	
	
	
	
	
	
})
