<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 标签管理
 */

class TagController extends AdminBaseController
{
	private $db;
//	构造函数
	public function __construct(){
	    parent::__construct();
		$this->db = D('Tag');
	}
	
//	添加标签
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()) $this->error($this->db->getError());
			$this->success('添加标签成功！');
		}else{
			$this->display();
		}
	    
	}
	
//	修改标签
	public function edit(){
		if(IS_POST){
			if(!$this->db->editData()) $this->error($this->db->getError());
			$this->success('修改成功！');
		}else{
			$this->assign('data',$this->db->getDataByTid(I('get.tid')));
			$this->display();
		}
	    
	}
	
//	标签列表
	public function index(){
		$this->assign('data',$this->db->getAllData());
	    $this->display();
	}
	
//	删除标签
	public function delete(){
	    if($this->db->deleteData()){
	    	$this->success('删除成功！');
	    }else{
	    	$this->error('删除失败！');
	    }
		
	}
	
	
	
}
 
 
 
 
