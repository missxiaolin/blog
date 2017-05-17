<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 分类管理
 */
class CategoryController extends AdminBaseController
{
//	分类表
	private $db;
//	定义category表数
	private $categoryData;
	
	public function __construct(){
	    parent::__construct();
		$this->db = D('Category');
//		获取数据并且赋值给$categoryData
		$this->categoryData = $this->db->getAllData();
	}
	
//	分类列表
	public function index(){
		$this->assign('data',$this->categoryData);
	    $this->display();
	}
	
//	分类排序
	public function sort(){
//		排序
	    if(IS_POST){
			$data = I('post.');
			if(!empty($data)){
				foreach ($data as $k => $v) {
					$this->db->where(array('cid'=>$k))->save(array('sort'=>$v));
				}
				$this->success('修改成功',U('Admin/Category/index'));
			}
		}
	}
	
//	分类添加
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()) $this->error($this->db->getError());
			$this->success('分类添加成功！');
		}else{
			$cid = I('get.cid',0,'intval');
			if($cid) $this->assign('cid',$cid);
			$this->assign('data',$this->categoryData);
	    	$this->display();
		}
	}
	
//	修改分类
	public function edit(){
		if(IS_POST){
			if(!$this->db->editData()) $this->error($this->db->getError());
			$this->success('修改成功',U('Admin/Category/index'));
		}else{
//			原数据
			$cid = I('get.cid',0,'intval');
			$onedata = $this->db->getDataByCid($cid);
//			所属栏目数据
			$data=$this->categoryData;
            $childs=$this->db->getChildData($cid);
            foreach ($data as $k => $v) {
                if(in_array($v['cid'], $childs)){
                    $data[$k]['_html']=" disabled='disabled' style='background:#F0F0F0'";
                }else{
                    $data[$k]['_html']=" ";
                }
            }
			$this->assign('data',$data);
			$this->assign('onedata',$onedata);
			$this->display();
		}
	}
	
//	删除分类
	public function delete(){
	    if($this->db->deleteData()){
	    	 $this->success('删除成功');
	    }else{
	    	$this->error($this->db->getError());
	    }
	}
	
}
