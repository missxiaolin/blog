<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 随言碎语管理
 */
class ChatController extends AdminBaseController {
//	定义数据库
	private $db;
	
	public function __construct(){
	    parent::__construct();
	    $this->db = D('Chat');
	}
	
//	随言碎语列表
	public function index(){
		$data = $this->db->getDataByState(0,'all');
		$this->assign('data',$data);
	   	$this->display();
	}
	
//	随言碎语添加
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()) $this->error($this->db->getError());
			$this->success('添加成功',U('Admin/Chat/index'));
		}else{
	    	$this->display();			
		}

	}
	
	
//	随言碎语修改
	public function edit(){
		if(IS_POST){
			if(!$this->db->editData()) $this->error($this->db->getError());
			$this->success('修改成功',U('Admin/Chat/index'));
		}else{
			$chid=I('get.chid');
            $data=$this->db->getDataByLid($chid);
            $this->assign('data',$data);
            $this->display();	
		}
	}
	
	
}