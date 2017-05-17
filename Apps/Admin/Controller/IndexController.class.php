<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页
 */
class IndexController extends AdminBaseController {
//	后台首页
    public function index(){
//  	分配菜单数据
		$nav_data = D('AdminNav')->getTreeData('level','order_number,id');
		$this->assign('data',$nav_data);
		$this->display();
    }
	
//	欢迎页面
	public function welcome(){
		$assign = array(
			'all_article' => D('Article')->getCountData(),//文章总数
			'delete_article' => D('Article')->getCountData(array('is_delete'=>1)),//已删文章
			'hide_article' => D('Article')->getCountData(array('is_show'=>0)),//不显示的文章
			'all_chat' => D('Chat')->getCountData(),//随言碎语总数
			'delete_chat' => D('Chat')->getCountData(array('is_delete'=>1)),//随言碎语删除条数
			'hide_chat' => D('Chat')->getCountData(array('is_show'=>0)),//随言碎语不显示条数
			'all_comment' => M('Comment')->count()
		);
//		分配到模板
		$this->assign($assign);
	    $this->display();
	}
	
}