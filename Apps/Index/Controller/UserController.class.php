<?php
namespace Index\Controller;

use Common\Controller\HomeBaseController;

class UserController extends HomeBaseController {
//    第三方平台登录
    public function oauth_login(){
        $type = I('get.type');
        import("Org.ThinkSDK.ThinkOauth");
        $sdk=\ThinkOauth::getInstance($type);
        redirect($sdk->getRequestCodeURL());
    }

    // 第三方平台退出
    public function logout(){
        session('users',null);
    }
}

