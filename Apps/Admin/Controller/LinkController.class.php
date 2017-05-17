<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 友情链接管理
 */
class LinkController extends AdminBaseController{
	
	private $db;
	
//	构造函数
	public function __construct(){
	    parent::__construct();
		$this->db = D('Link');
	}
	
//	添加友情链接
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()) $this->error($this->db->getError());
			$this->success('添加友情链接成功！',U('Admin/Link/index'));
		}else{
			$this->display();
		}
	    
	}
	
//	显示友情链接
	public function index(){
		$data = $this->db->getDataByState(0,'all');
		$this->assign('data',$data);
	    $this->display();
	}

	public function edit(){
	    if(IS_POST){
            
        }else{
//            获取原数据
            $this->display();
        }
    }
	
	
	
}