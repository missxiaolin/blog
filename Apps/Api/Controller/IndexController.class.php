<?php
namespace Api\Controller;

use Common\Controller\HomeBaseController;

class IndexController extends HomeBaseController {

    public function oauth(){
        $type=I('get.type');
        $code=I('get.code');
        //加载ThinkOauth类并实例化一个对象
        import("Org.ThinkSDK.ThinkOauth");
        $sns  = \ThinkOauth::getInstance($type);
        $token = $sns->getAccessToken($code);
        //获取当前登录用户信息
        if(is_array($token)){
            // 获取第三方账号数据
            $user_info = $this->$type($token);
            $data=array(
                'uid'=>0,
                'type'=>$user_info['type'],
                'nickname'=>$user_info['nickname'],
                'head_img'=>$user_info['head_img'],
                'openid'=>$token['openid'],
                'access_token'=>$token['access_token'],
                );
            // 获取本地数据库的用户数据
            $user_data=D('OauthUser')->getDataByOpenid($data['openid']);
            // 如果登陆过 则覆盖；没有登陆这添加数据
            if(empty($user_data)){
                $id=D('OauthUser')->addData($data);
            }else{
                $id=D('OauthUser')->editData($data);
            }
            // 组合存session的数据
            $login_info=array(
                'id'=>$id,
                'head_img'=>$data['head_img'],
                'nickname'=>$data['nickname'],
                );
            session('users',$login_info);
            // 跳转到登陆前的页面
            $_COOKIE['this_url']=empty($_COOKIE['this_url']) ? '/' : cookie('this_url');
            redirect($_COOKIE['this_url']);
        }
    }





    //登录成功，获取腾讯QQ用户信息
    public function qq($token){
        import("Org.ThinkSDK.ThinkOauth");
        $qq   = \ThinkOauth::getInstance('qq', $token);
        $data = $qq->call('user/get_user_info');
        if($data['ret'] == 0){
            $userInfo['type'] = 1;
            $userInfo['name'] = $data['nickname'];
            $userInfo['nickname'] = $data['nickname'];
            $userInfo['head_img'] = $data['figureurl_qq_2'];
            return $userInfo;
        } else {
            throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
        }
    }



}
