<?php 
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 网站设置
 */
class ConfigController extends AdminBaseController{
//	定义数据库
	private $db;
	
	public function __construct(){
	    parent::__construct();
		$this->db = D('Config');
	}
	
	
	
//	网站配置项
	public function index(){
		if(IS_POST){
			if($this->db->editData()){
                $this->success('修改成功',U('Admin/Config/index'));
            }else{
                $this->error('修改失败');
            }
		}else{
			$data = $this->db->getAllData();
			$this->assign('data',$data);
		    $this->display();
		}

	}
	
//	修改密码
	public function change_password(){
		if(IS_POST){
			$data = I('post.');
			if(!D('Users')->changePassword($data)) $this->error(D('Users')->getError());
			$this->success('修改成功');
		}else{
			$this->display();
		}
	    
	}
	
	
	
	
	
	
	
	
	
}