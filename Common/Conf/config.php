<?php
return array(
    'SESSION_AUTO_START'    => true,   //是否开启session
    'APP_GROUP_LIST' => 'Admin,Index', //项目分组设定
	'DEFAULT_MODULE' => 'Index', //默认模块
//***********************************URL*************************************
	'URL_MODEL'             =>	0,			 				//URL模式
	'URL_CASE_INSENSITIVE'  =>  false,						//URL不区分大小写
//********************************附加设置***********************************
    'LOAD_EXT_CONFIG'       =>  'db,webconfig,oauth',
    'AUTOLOAD_NAMESPACE'    => array(                          //注册命名空间
        'Common'            => COMMON_PATH,                    //Common移动根目录
        'Lib'               => COMMON_PATH . 'Lib',            //lib 第三方类库
    ),
    'TAGLIB_BUILD_IN'       =>  'Cx,Common\Tag\My',         //加载自定义标签
    'TAGLIB_PRE_LOAD'       =>  'Common\Tag\My',            //标签库预加载
	'TMPL_PARSE_STRING'     =>  array(                      //定义常用路径
        '__HOME_CSS__'      =>  __ROOT__.'/Public/Home/css',
        '__HOME_JS__'       =>  __ROOT__.'/Public/Home/js',
        '__HOME_IMAGE__'    =>  __ROOT__.'/Public/Home/image',
        '__ADMIN_CSS__'     =>  __ROOT__.'/Public/Admin/css',
        '__ADMIN_JS__'      =>  __ROOT__.'/Public/Admin/js',
        '__ADMIN_IMAGE__'   =>  __ROOT__.'/Public/Admin/image',
    ),
    'SHOW_PAGE_TRACE'=>'',                              //页面Trace









);