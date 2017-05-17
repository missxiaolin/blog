<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 文章管理
 */
class ArticleController extends AdminBaseController
{
//	定义数据表
	private $db;
	
	public function __construct(){
	    parent::__construct();
		$this->db = D('Article');
	}
	
	
//	添加文章
	public function add(){
		if(IS_POST){
			if(!$this->db->addData()) $this->error($this->db->getError());
			$this->success('文章添加成功',U('Admin/Article/index'));
		}else{
			$allCategory = D('Category')->getAllData();
			if(empty($allCategory)) $this->error('请先添加分类',U('Admin/Category/add'));
//			获取标签
			$allTag = D('Tag')->getAllData();
//			分配到模板
			$this->assign('allCategory',$allCategory);
			$this->assign('allTag',$allTag);
			$this->display();
		}
	    
	}

//	百度推送




	
	
	//uploadify异步上传
	public function upload(){
		$info = image_upload();
		if(!is_array($info)){
			echo json_encode($info);
			exit;
		}else{
			echo json_encode($info['Filedata']);
		}
	}
	
	
//	显示文章
	public function index(){
		$data = $this->db->getPageData('all','all','all',0,15);
		$this->assign('data',$data['data']);
        $this->assign('page',$data['page']);
	    $this->display();
	}
	
	
//	修改文章
	public function edit(){
		if(IS_POST){
			if($this->db->editData()){
                $this->success('修改成功',U('Admin/Article/index'));
            }else{
                $this->error('修改失败');
            }
		}else{
			$aid = I('get.aid',0,'intval');
			$data = $this->db->getDataByAid($aid);
			$allCategory=D('Category')->getAllData();
            $allTag=D('Tag')->getAllData();
            $this->assign('allCategory',$allCategory);
            $this->assign('allTag',$allTag);
            $this->assign('data',$data);
			$this->display();
		}
	    
	}
	
	
//	删除文章
	public function delete(){
        if($this->db->deleteData()){
            $this->success('彻底删除成功');
        }else{
            $this->error('彻底删除失败');
        }
    }
	
	
}
