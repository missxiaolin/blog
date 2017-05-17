<?php

header("Content-type:text/html;charset=utf-8");

//格式化输出数据
function p($data){
	//定义样式
	$str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
	//判断数据类型
	if (is_bool($data)) {
		$show_data=$data?'true':'false';
	}else if(is_null($data)){
		$show_data='null';
	}else{
		$show_data=print_r($data,true);
	}
	$str .= $show_data;
	$str .= '<pre/>';
	echo $str;
}

//设置生成验证码
function show_verify($config=''){
	if ($config=='') {
		$config=[
			'codeSet'  =>'1234567890',
			'fontSize' =>30,
			'useCurve' =>false,
			'imageW'   =>240,
			'imageH'   =>60,
			'length'   =>4,
			'fontttf'  =>'4.ttf',
		];
		$verify= new \Think\Verify($config);
		return $verify->entry();
	}
}

// 检测验证码
function check_verify($code){
    $verify=new \Think\Verify();
    return $verify->check($code);
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str){
	$preg = '/\/Upload\/image\/ueditor\/\d*\/\d*\.[jpg|jpeg|png|bmp]*/i';
	preg_match_all($preg, $str ,$data);
	return current($data);
}

/**
 * 传递图片路径根据配置项添加水印
 * @param string $path 图片路径
 */
function add_water($path){
    $image=new \Think\Image();
    if(C('WATER_TYPE')==1){
        $image->open($path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save($path);
    }elseif(C('WATER_TYPE')==2){
        $image->open($path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save($path);
    }elseif(C('WATER_TYPE')==3){
        $image->open($path)->text(C('TEXT_WATER_WORD'),C('TEXT_WATER_TTF_PTH'),C('TEXT_WATER_FONT_SIZE'),C('TEXT_WATER_COLOR'),C('TEXT_WATER_LOCATE'),0,C('TEXT_WATER_ANGLE'))->save($path);
        $image->open($path)->water(C('IMAGE_WATER_PIC_PTAH'),C('IMAGE_WATER_LOCATE'),C('IMAGE_WATER_ALPHA'))->save($path);
    }
}

/**
 * 将ueditor存入数据库的文章中的图片绝对路径转为相对路径
 * @param  string $content 文章内容
 * @return string          转换后的数据
 */
function preg_ueditor_image_path($data){
    // 兼容图片路径
    $root_path=rtrim($_SERVER['SCRIPT_NAME'],'/index.php');
    // 正则替换图片
    $data=htmlspecialchars_decode($data);
    $data=preg_replace('/src=\"^\/.*\/Upload\/image\/ueditor$/','src="'.$root_path.'/Upload/image/ueditor',$data);
    return $data;
}


/**
 * 文件上传
 */
function image_upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728;// 设置附件上传大小
		$upload->exts = array('jpg','gif','png','jpeg');// 设置附件上传类型
		$upload->rootPath = './Tmps/'; // 设置附件上传根目录
		$upload->replace = true; //存在同名文件是否是覆盖
		$info = $upload->upload();

		if(!$info){
			return $upload->getError();
		}else{
			return $info;
		}
		
}
    
    




















