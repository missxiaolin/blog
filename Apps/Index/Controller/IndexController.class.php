<?php
namespace Index\Controller;
use Common\Controller\HomeBaseController;

/**
 * 首页 
 */

class IndexController extends HomeBaseController {
//	首页
    public function index(){
		$articles = D('Article')->getPageData();
		$LinkData = D('Link')->getDataByState(0,'all');
		$assign=array(
            'articles'=>$articles['data'],
            'page'=>$articles['page'],
            'link'=>$LinkData,
            'cid'=>'index'
            );
//      p($assign);
		$this->assign($assign);
		$this->display();
    }
    
//  文章内容
    public function content(){
    	$aid = I('get.aid',0,'intval');
    	$cid = intval(cookie('cid'));
    	$tid = intval(cookie('tid'));
    	$seach_word = cookie('seach_word');
    	$search_word=empty($search_word) ? 0 : $search_word;
        $read=cookie('read');
//      判断是否记录过aid
		if(array_key_exists($aid,$read)){
//			判断点击本篇文章时间是否超过1天
			if($read[$aid]-time()>=86400){
				$read[$aid] = time();
//				文章点击+1
				M('Article')->where(array('aid'=>$aid))->setInc('click',1);
			}
		}else{
			$read[$aid] = time();
//			文章点击+1
			M('Article')->where(array('aid'=>$aid))->setInc('click',1);
		}
		cookie('read',$read,864000);
        switch(true){
            case $cid==0 && $tid==0 && $search_word==(string)0:
                $map=array();
                break;
            case $cid!=0:
                $map=array('cid'=>$cid);
                break;
            case $tid!=0:
                $map=array('tid'=>$tid);
                break;
            case $search_word!==0:
                $map=array('title'=>$search_word);
                break;
        }
		$article = D('Article')->getDataByAid($aid,$map);
//		判断如何文章不存在的情况下
		
//		评论数据
//		p($article);
		
//		获取相关文章
//		sql
		$where=array(
                'cid'=>$article['current']['cid'],
                'is_show'=>1,
                'is_delete'=>0,
            );
		$relevantData = D('Article')->field('aid,title')->where($where)->order('addtime desc')->limit(8)->select();
//		p($relevantData);
		$assign = array(
			'articles' => $article,
			'relevantData'=>$relevantData
		);
		
		$this->assign($assign);
    	$this->display();
    }
    
//  分类文章
    public function new_list(){
    	$cid = I('get.cid',0,'intval');
//  	获取分类数据
		$category = D('Category')->getDataByCid($cid);
		
//		判断分类是否存在
		
//		获取分类下的文章数据
		$articles = D('Article')->getPageData($cid);
//		p($articles);
//		分配数据显示模板
		$assign = array(
			'category'=>$category,
			'articles'=>$articles['data'],
			'page'=>$articles['page'],
		);
		$this->assign($assign);
        $this->display();
    }
    
    
    
//  关于我
	public function about(){
	    $this->display();
	}
}