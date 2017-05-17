<?php 
namespace Common\Controller;
use Think\Controller;
/**
 * 后台Controller
 */
class AdminBaseController extends Controller
{
	/**
	 * 初始方法
	 */
	public function _initialize(){
		$auth=new \Think\Auth();
		$rule_name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
//		先判断是否登陆
		if(empty($_SESSION['user'])){
			redirect(U('Admin/Login/login'));
		}
//		权限的控制
		$result=$auth->check($rule_name,$_SESSION['user']['id']);
		if(!$result){
		 	$this->error('您没有权限访问');
		}
	}
	
	
}











?>