<?php 
namespace Common\Model;
use Common\Model\BaseModel;

class CommentModel extends BaseModel
{
	
	/**
     * 获取分页数据供后台使用
     * @param  int   是否删除
     * @return array 评论数据
     */
    public function getDataByState($is_delete){
        $count=$this
            ->alias('c')
            ->join('__ARTICLE__ a ON a.aid=c.aid')
            ->join('__OAUTH_USER__ ou ON ou.id=c.ouid')
            ->where(array('c.is_delete'=>$is_delete))
            ->count();
        $page=new \Common\Lib\Page($count,15);
        $list=$this
            ->field('c.*,a.title,ou.nickname')
            ->alias('c')
            ->join('__ARTICLE__ a ON a.aid=c.aid')
            ->join('__OAUTH_USER__ ou ON ou.id=c.ouid')
            ->where(array('c.is_delete'=>$is_delete))
            ->limit($page->firstRow.','.$page->listRows)
            ->order('date desc')
            ->select();
        $data=array(
            'data'=>$list,
            'page'=>$page->show()
            );

        return $data;
    }
	
	
	
}