$(function(){
//	收货地址
	
	$('.user').blur(function(){
		if($(this).val()==''){
			$(this).next('.ts').show();
		}else{
			$(this).next('.ts').hide();
		}
	})
	
	$('.ressd').blur(function(){
		if($(this).val()==''){
			$(this).next('.ts').show();
		}else{
			$(this).next('.ts').hide();
		}
	})
	
	$('.phone').blur(function(){
		if($(this).val()==''){
			$(this).next().next('.ts').show();
		}else{
			$(this).next().next('.ts').hide();
		}
	})
	
	
	
	
	
	$("#from").submit(function(){
//		收货人
		if($('.user').val()==''){
			$('.user').next('.ts').show();
			return false;
		}
//		详细地址
		if($('.ressd').val()==''){
			$('.ressd').next('.ts').show();
			return false;
		}
		if($('.phone').val()==''){
			$('.phone').next().next('.ts').show();
			return false;
		}
		alert(1);
	})
	
	$('.dj').click(function(){
		var value = $(this).attr('title');
		$('.alias').val(value);
	})
	
	
	
	function max(){
		var w = $(window).width();
		var h = $(window).height();
		var he = window.screen.availHeight;
		
		$('#max_canva').css({
			'height':h+'px',
			'width':w+'px',
		});
		
		l = (w-$('#new_dz').width())/2;
		t = (he-$('#new_dz').height())/4;
		$('#new_dz').css({
			'left':l+'px',
			'top':t+'px'
		});
	}
	max();
	$(window).resize(function(){
		max();
	})
	
	
	
//	点击显示
	$('#show').click(function(){
		$('#max_canva').show();
		$('#new_dz').show();
	})
	
//	点击隐藏
	$('#hide').click(function(){
		$('#max_canva').hide();
		$('#new_dz').hide();
	})
	
	
	
	
//	点击选中
	$('.consignee_item').click(function(){
		$('#main .steps .scroll ul li').removeClass('active');
		$(this).parent('li').addClass('active')
	})
//	大于0隐藏
	$('#main .steps .scroll ul li:gt(0)').hide();
//	点击判断文本内容进行切换
	$('#main .steps .scroll .zk').click(function(){
		if($(this).html()=='更多地址'){
			$(this).html('收起地址');
			$('#main .steps .scroll ul li').show();
		}else if($(this).html()=='收起地址'){
			$(this).html('更多地址');
			$('#main .steps .scroll ul li:gt(0)').hide();
		}
		
	})
	
//	支付方式
	$('#main .steps .scroll .pay a').click(function(){
		$('#main .steps .scroll .pay a').removeClass('actibe');
		$(this).addClass('actibe');
	})
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
})
