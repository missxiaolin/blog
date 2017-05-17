<?php 
namespace Common\Model;
use Common\Model\BaseModel;
/**
 *  分类model
 */
class CategoryModel extends BaseModel
{
	/**
	 * 自动验证
	 */
	protected $_validate = array(
		array('cname','require','分类名不能为空',3),
		array('cname','0,15','分类名长度不符合',3,'length'),
        array('sort','number','排序必须为数字',3),
	);
	
	/**
	 * 添加分类
	 */
	public function addData(){
	    if(!$this->create()) return FALSE;
		$this->add();
		return TRUE;
	}
	
	/**
	 * 修改分类
	 */
	
	public function editData(){
	    if(!$this->create()) return FALSE;
		$this->where(array('cid'=>$this->data['cid']))->save($this->data);
		return TRUE;
	}
	
	/**
	 * 删除分类
	 */
	
	public function deleteData(){
	    $cid = is_null($cid) ? I('get.cid') : $cid;
		$child = $this->getChildData($cid);
		if(!empty($child)){
			$this->error = '请先删除子分类';
			return FALSE;
		}
		$arrticleData = D('Article')->getDataByCid($cid);
		if(!empty($arrticleData)){
			$this->error='请先删除此分类下的文章';
            return false;
		}
		if($this->where(array('cid'=>$cid))->delete()){
            return true;
        }else{
            return false;
        }
	}
	
	
	/**
	 * 传递数据库对应的字段名 获取对应的数据
	 * 不传递参数获取全部数据
	 * F('Arc/data',$data);	快速缓存(如果不需要设置缓存时间可以用快速缓存)
	 */
	public function getAllData($field='all',$tree=TRUE){
	    if($field=='all'){//全部
	    	if(S('Cate')){
				$data = S('Cate');
	    	}else{
	    		$data = $this->order('sort')->select();
				// 采用文件方式缓存数据300秒
    			S('Cate',$data,array('type'=>'file','expire'=>300));
	    	}
			if($tree){
				return \Common\Lib\Data::tree($data,'cname');
			}else{
				return $data;
			}
	    }else{//获取单个
	    	return $this->getField("cid,$field");
	    }
	}
	
	/**
	 * 传递cid和field获取对应的数据
	 */
	public function getDataByCid($cid,$field='all'){
	    if($field=='all'){
	    	return $this->where(array('cid'=>$cid))->find();
	    }else{
	    	return $this->where(array('cid'=>$cid))->getField($field);
	    }
	}
	
	/**
	 * 传递cid获得所有子栏目
	 */
	public function getChildData($cid){
	    $data = $this->getAllData('all',FALSE);
		$child = \Common\Lib\Data::channelList($data,$cid);
        foreach ($child as $k => $v) {
            $childs[]=$v['cid'];
        }
		return $childs;
	}
}
