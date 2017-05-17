<?php 
namespace Common\Model;
use Think\Model;
/**
 * 权限管理
 */
 
class AuthRuleModel extends Model{
	
//	添加权限
	public function addData($data){
//	            去除首尾空格
		foreach ($data as $k => $v) {
			$data[$k] = trim($v);
		}
		$this->add($data);
		return true;
	}
	
	
	/**
     * 修改数据
     * @param   array   $data   数据
     */
    public function editData($data){
        // 去除键值首位空格
        foreach ($data as $k => $v) {
            $data[$k]=trim($v);
        }
        $this->where(array('id'=>$data['id']))->save($data);
        return true;
    }
    
    /**
	 * 删除数据
	 * @param	array	$map	where语句数组形式
	 * @return	boolean			操作是否成功
	 */
	public function deleteData($map){
		$count=$this
			->where(array('pid'=>$map['id']))
			->count();
		if($count!=0){
			return false;
		}
		$this->where($map)->delete();
		return true;
	}

	
	/**
     * 获取全部数据
     * @param  string $type  tree获取树形结构 level获取层级结构
     * @param  string $order 排序方式   
     * @return array         结构数据
     */
    public function getTreeData($type='tree',$order='',$name='name',$child='id',$parent='pid'){
        // 判断是否需要排序
        if(empty($order)){
            $data=$this->select();
        }else{
            $data=$this->order($order.' is null,'.$order)->select();
        }
        // 获取树形或者结构数据
        if($type=='tree'){
            $data=\Common\Lib\Data::tree($data,$name,$child,$parent);
        }elseif($type="level"){
            $data=\Common\Lib\Data::channelLevel($data,0,'&nbsp;',$child);
        }
//      p($data);
        return $data;
    }
	
	
	
	
	
	
	
}