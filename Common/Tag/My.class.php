<?php
namespace Common\Tag;
use Think\Template\TagLib;

class My extends TagLib{
	//定义标签
	protected $tags =array(
		'jquery'       =>array('attr'=>'','close'=>0),
		'animate'      =>array('attr'=>'','close'=>0),
		'bootstrapcss' =>array('','close'=>0),
		'uploads' =>array('','close'=>0),
		'bootstrapjs'  =>array('','close'=>0),
        'bootstrapjs_index'  =>array('','close'=>0),
		'icheckcss'=>array('','close'=>0),
        'icheckjs'=>array('attr'=>'icheck','close'=>0),
        'ueditor'=> array('attr'=>'name,content','close'=>0),
//      前台
		'home'=> array('','close'=>0),
	);

	//引入jquery
	public function _jquery(){
		return '<script src="__PUBLIC__/static/js/jquery-2.0.0.min.js"></script>';
	}

	//引入animate
    public function _animate(){
        return '<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/css/animate.css">';
    }

    //bootstrap的css部分
    public function _bootstrapcss(){
        $link=<<<php
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/css/bjy.css">
    <link rel="stylesheet" type="text/css" href="__HOME_CSS__/index.css">
php;
        return $link;
    }

    //引入jquery、bootstrap的js部分(前台)
    public function _bootstrapjs_index(){
        $web_statistics=C('WEB_STATISTICS');
        $link=<<<php
<script src="__PUBLIC__/static/js/jquery-2.0.0.min.js"></script>
<script>
    logoutUrl="{:U('Index/User/logout')}";
</script>
<script src="__PUBLIC__/static/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="__HOME_JS__/index.js"></script>
php;
        return $link;
    }


    //引入jquery、bootstrap的js部分
    public function _bootstrapjs(){
        $web_statistics=C('WEB_STATISTICS');
        $link=<<<php
<script src="__PUBLIC__/static/js/jquery-2.0.0.min.js"></script>
<script>
    logoutUrl="{:U('Index/User/logout')}";
</script>
<script src="__PUBLIC__/static/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="__PUBLIC__/static/js/html5shiv.min.js"></script>
<script src="__PUBLIC__/static/js/respond.min.js"></script>
<![endif]-->
<script src="__PUBLIC__/static/pace/pace.min.js"></script>
php;
        return $link;
    }

    //引入ickeck的css部分
    public function _icheckcss(){
        $link=<<<php
    <link rel="stylesheet" href="__PUBLIC__/static/iCheck-1.0.2/skins/all.css">
php;
        return $link;
    }

    //引入ickeck的js部分
    public function _icheckjs(){
        $link=<<<php
<script src="__PUBLIC__/static/iCheck-1.0.2/icheck.min.js"></script>
<script>
$(document).ready(function(){
    $('.icheck').iCheck({
        checkboxClass: "icheckbox_square-blue",
        radioClass: "iradio_square-blue",
        increaseArea: "20%"
    });
});
</script>
php;
        return $link;
    }

    /**
    * 引入ueidter编辑器
    * @param string $tag  name:表单name content：编辑器初始化后 默认内容
    */
    public function _ueditor($tag){
        $name=isset($tag['name']) ? $tag['name'] : 'content';
        $content=isset($tag['content']) ? $tag['content'] : '';
        $link=<<<php
<script id="container" name="$name" type="text/plain">$content</script>
<script src="__PUBLIC__/static/ueditor1_4_3/ueditor.config.js"></script>
<script src="__PUBLIC__/static/ueditor1_4_3/ueditor.all.js"></script>
<script>
    var ue = UE.getEditor('container');
</script>
php;
        return $link;
    }


	/**
    * 引入上上传插件
    */
    public function _uploads(){
         $link=<<<php
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/uploadify/uploadify.css">
    
    <script src="__PUBLIC__/static/uploadify/jquery.uploadify.min.js"></script>
php;
        return $link;
    }


//	前台
	public function _home(){
	    $link=<<<php
<link href="__PUBLIC__/Index/css/base.css" rel="stylesheet">
	<link href="__PUBLIC__/Index/css/index.css" rel="stylesheet">
php;
        return $link;
	}

}