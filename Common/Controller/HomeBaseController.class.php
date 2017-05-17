<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * 前台基类Controller
 */
class HomeBaseController extends BaseController{
	/**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();
//      头部分类信息
		$data = D('Category')->getAllData();
//      右边置顶文章
//		sql
		$recommend_map = array(
			'is_show'=>1,
			'is_delete'=>0,
			'is_top'=>1
		);
		$recommend = M('Article')
					->field('aid,title')
					->where($recommend_map)
					->order('aid desc')
					->select();
//		点击排行
		$sql = array(
			'is_show'=>1,
			'is_delete'=>0,
		);
		$clickArticle = M('Article')
						->field('aid,title')
						->where($sql)
						->order('addtime desc')
						->limit(5)
						->select();
						
		$assign = array(
			'data'=>$data,
			'recommend'=>$recommend,
			'clickArticle'=>$clickArticle
		);
		$this->assign($assign);
    }
	
	
	
	
	
	
	
	
}