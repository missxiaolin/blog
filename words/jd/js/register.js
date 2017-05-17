$(function(){
//个人用户注册
//	用户名
//0px -100px感叹号
//-17px -100px错误
	function shows(a,b,c){
		$(a).parent().next('.input_tip').find('i').css({
			"background-position":c,
		})
		$(a).parent().next('.input_tip').find('span').html(b);
		$(a).parent().next('.input_tip').show();
	}
	function hides(a){
		$(a).parent().next('.input_tip').find('span').html('');
		$(a).parent().next('.input_tip').hide();
	}
	$('#username').focus(function(){
		shows('#username','支持中文、字母、数字、"-"、"_" 的组合 ,4-20个字符！','0px -100px');

	})
	$('#username').blur(function(){
		hides('#username');
	})
//	密码
	$('#password').focus(function(){
		shows('#password','建议使用字母、数字和符号两种及以上的组合,6-20个字符！','0px -100px');
	})
	$('#password').blur(function(){
		hides('#password');

	})
//	确认密码
	$('#oldpassword').focus(function(){
		shows('#oldpassword','请再次输入密码！','0px -100px');
	})
	$('#oldpassword').blur(function(){
		hides('#oldpassword');
	})
//	邮箱验证
	$('#email').focus(function(){
		shows('#email','完成验证后,你可以用该邮箱登录和找回密码！','0px -100px');
	})
	$('#email').blur(function(){
//		正则
		var filter  = /^[A-Za-z0-9]+([-_.][A-Za-z0-9]+)*@([A-Za-z0-9]+[-.])+[A-Za-z0-9]{2,5}$/;
		if($(this).val().match(filter)==null){
			shows('#email','邮箱格式不正确！','-17px -100px');
			return false;
		}
		hides('#email');

	})
//	图片
	$('#cold').focus(function(){
		shows('#cold','看不清？点击图片跟还验证码！','0px -100px');
	})
	$('#cold').blur(function(){
		hides('#cold');
	})
//	提交验证
	$('#from').submit(function(){
//		用户名
		if($('#username').val()==''){
			shows('#username','请填写用户名！','-17px -100px');
			return false;
		}
//		密码
		if($('#password').val()==''){
			shows('#password','请填写密码！','-17px -100px');
			return false;
		}
//		正则（输入6-16个以字母开头、可带数字、“_”、“.”的字串 ）
		var filer  = /^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){5,19}$/;
		if($('#password').val().match(filer)==null){
			shows('#password','建议使用字母、数字和符号两种及以上的组合,6-20个字符！','-17px -100px');
			return false;
		}
//		确认密码
		if($('#oldpassword').val()==''){
			shows('#oldpassword','请再次填写密码！','-17px -100px');
			return false;
		}
//		密码不一致
		if($('#oldpassword').val() != $('#password').val()){
			shows('#oldpassword','确认密码和原密码不一致！','-17px -100px');
			return false;
		}
//		邮箱验证
		if($('#email').val() == ''){
			shows('#email','请填写邮箱！','-17px -100px');
			return false;
		}
//		正则
		var filter  = /^[A-Za-z0-9]+([-_.][A-Za-z0-9]+)*@([A-Za-z0-9]+[-.])+[A-Za-z0-9]{2,5}$/;
		if($('#email').val().match(filter)==null){
			shows('#email','邮箱格式不正确！','-17px -100px');
			return false;
		}
//		验证码
		if($('#cold').val() == ''){
			shows('#cold','请填写验证码！','-17px -100px');
			return false;
		}
//		如果没有同意不给提交
		if($('#che').val()==''){
			$('.ty').show();
			return false;
		}
//		全部通过就可以伊布提交
		
	})
	
	
	
	
	
	
	
//	企业用户注册
//	获得焦点
	function sw(a,b){
		$(a).next().next('.ts').removeClass('ad');
		$(a).next().next('.ts').html(b);
		$(a).next().next('.ts').show();
	}
	function ss(a,b){
		$(a).next().next('.ts').addClass('ad');
		$(a).next().next('.ts').html(b);
		$(a).next().next('.ts').show();
	}
//	失去焦点
	function sq(a){
		$(a).next().next('.ts').hide();
	}
//	用户名
	$('.user').focus(function(){
		sw('.user','4-20位字符、支持汉字、字母、数字"-"、"_"组合!');
	})
	$('.user').blur(function(){
		sq('.user');
	})
//	密码
	$('.pass').focus(function(){
		sw('.pass','6-20位字符,建议由字母,数字和符号两种以上组合!');
	})
	$('.pass').blur(function(){
//		正则（输入6-16个以字母开头、可带数字、“_”、“.”的字串 ）
		var filer  = /^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){5,19}$/;
		if($('.pass').val().match(filer)==null){
			ss('.pass','请使用字母、数字、符号及以上的组合,6-20个字符');
			return false;
		}
		sq('.pass');
	})
//	确认密码
	$('.qrpass').focus(function(){
		sw('.qrpass','请再次输入密码!');
	})
	$('.qrpass').blur(function(){
		if($('.pass').val() != $('.qrpass').val()){
			ss('.qrpass','两次密码不一致!');
			return false;
		}
		sq('.qrpass');
	})
//	公司名称
	$('.firm').focus(function(){
		sw('.firm','请填写工商局注册的全称。4-40个字符,可由中英文、数字及"_"、"-"组成!');
	})
	$('.firm').blur(function(){
		sq('.firm');
	})
//	公司地址
	$('.names').focus(function(){
		sw('.names','北京市亦庄经济开发区科创十一街18号院B座14层!');
	})
	$('.names').blur(function(){
		sq('.names');
	})
//	联系人姓名
	$('.na').focus(function(){
		sw('.na','2-20位字符,可由中文或英文组成!');
	})
	$('.na').blur(function(){
		sq('.na');
	})
//	固定电话
	$('.phone').focus(function(){
		sw('.phone','请填写联系人常用的电话,以便于我们联系,如0527-88105500!');
	})
	$('.phone').blur(function(){
		sq('.phone');
	})
//	手机
	$('.sj').focus(function(){
		sw('.sj','请填写本人手机号,审核信息以短信通知!');
	})
	$('.sj').blur(function(){
		sq('.sj');
	})
//	邮箱
	$('.email').focus(function(){
		sw('.email','请填写本人邮箱,审核信息以邮件通知!');
	})
	$('.email').blur(function(){
		sq('.email');
	})
	
	$('#frm').submit(function(){
//		用户名
		if($('.user').val()==''){
			ss('.user','请先填写用户!');
			return false;
		}
//		密码
		if($('.pass').val()==''){
			ss('.pass','请先填密码!');
			return false;
		}
//		正则（输入6-16个以字母开头、可带数字、“_”、“.”的字串 ）
		var filer  = /^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){5,19}$/;
		if($('.pass').val().match(filer)==null){
			ss('.pass','请使用字母、数字、符号及以上的组合,6-20个字符');
			return false;
		}
//		确认密码
		if($('.qrpass').val()==''){
			ss('.qrpass','请确认密码!');
			return false;
		}
		if($('.qrpass').val() != $('.pass').val()){
			ss('.qrpass','两次密码不一致!');
			return false;
		}
//		公司名称
		if($('.firm').val() ==''){
			ss('.firm','请先填写公司名称!');
			return false;
		}
//		公司地址
		if($('.names').val() ==''){
			ss('.names','请先填写公司地址!');
			return false;
		}
//		联系人
		if($('.na').val() ==''){
			ss('.na','请先填联系人!');
			return false;
		}
//		固定电话
		if($('.phone').val() ==''){
			ss('.phone','请先填固定电话方便联系您!');
			return false;
		}
//		手机
		if($('.sj').val() ==''){
			ss('.sj','请先填手机号码方便联系您!');
			return false;
		}
//		邮箱
		if($('.email').val() ==''){
			ss('.email','请先填邮箱方便联系您!');
			return false;
		}
//		正则
		var filter  = /^[A-Za-z0-9]+([-_.][A-Za-z0-9]+)*@([A-Za-z0-9]+[-.])+[A-Za-z0-9]{2,5}$/;
		if($('.email').val().match(filter)==null){
			ss('.email','邮箱格式不正确！');
			return false;
		}
		
		
//		同意才可注册
		if($('.tt').val()==''){
			$('#tongyi').show();
			return false;
		}
//		全部通过就可以伊布提交
	})
	
})











