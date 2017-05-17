<?php 
namespace Common\Model;
use Common\Model\BaseModel;
/**
 *  标签model
 */
class TagModel extends BaseModel
{
	/**
	 * 添加标签
	 */
	public function addData(){
		if(empty(I('post.tnames'))){
			$this->error = '标签名不能为空';
			return FALSE;
		}else{
			$tagData = explode('|', I('post.tnames'));
			foreach ($tagData as $k => $v) {
				$this->add(array('tname'=>$v));
			}
			return TRUE;
		}
	}
	
	/**
	 * 获得所有标签
	 */
	public function getAllData(){
	    $data = $this->select();
		foreach ($data as $k => $v) {
			$data[$k]['count'] = M('ArticleTag')->where(array('tid'=>$v['tid']))->count();
		}
		return $data;
	}
	
	/**
	 * 删除标签
	 */
	public function deleteData(){
	    $tid = I('get.tid',0,'intval');
		if($this->where(array('tid'=>$tid))->delete()){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/**
	 * 修改标签
	 */
	public function editData(){
	    if(empty(I('post.tname'))){
	    	$this->error = '标签不能为空！';
			return FALSE;
	    }else{
	    	$this->where(array('tid'=>I('post.tid',0,'intval')))->save(array('tname'=>I('post.tname')));
	    	return TRUE;
	    }
	}
	
	/**
	 * 根据tid获取单条数据
	 */
	public function getDataByTid($tid,$field='all'){
	    if($field=='all'){
            return $this->where(array('tid'=>$tid))->find();
        }else{
            return $this->getFieldByTid($tid,'tname');
        }
	}
	
}


