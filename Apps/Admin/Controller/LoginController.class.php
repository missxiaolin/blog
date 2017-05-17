<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台登陆
 */
class LoginController extends Controller
{
//	登陆页面
	public function login(){
		if(IS_POST){
			$map = I('post.');
			if(!check_verify($map['verify'])) $this->error('验证码有误',U('Admin/Login/login'));
			
			$map['password'] = md5($map['password']);
			$data = M('Users')->where($map)->find();
			if(empty($data)){
				$this->error('账号密码错误！');
			}else{
				$_SESSION['user']=array(
                    'id'=>$data['id'],
                    'username'=>$data['username'],
                    'avatar'=>$data['avatar']
                    );
				$this->success('登录成功、前往管理后台',U('Admin/Index/index'));
			}
			/**
			 * getFieldByName	针对某个字段查询并返回某个字段的值
			 */ 
//			$password = M('config')->getFieldByName('ADMIN_PASSWORD','value');
//			if(md5($data['ADMIN_PASSWORD'])!=$password) $this->error('密码输入有误',U('Admin/Login/login'));
//			session('admin','is_login');
		}else{
			$this->display();
		}
	    
	}
	
//	退出登录
	public function logout(){
	    session('admin',null);
		$this->success('退出成功',U('Admin/Login/login'));
	}
	
	
	
	//生成验证码
	public function showVerify(){
		show_verify();
	}
	
}


