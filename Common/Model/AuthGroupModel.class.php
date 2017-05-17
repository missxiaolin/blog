<?php 
namespace Common\Model;
use Think\Model;
/**
 * 用户组
 */
 
class AuthGroupModel extends Model{
	
//	添加数据
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
	 * 传递主键id删除数据
	 * @param  array   $map  主键id
	 * @return boolean       操作是否成功
	 */
	public function deleteData($map){
		$this->where($map)->delete();
		$group_map=array(
			'group_id'=>$map['id']
			);
		// 删除关联表中的组数据
		$result=D('AuthGroupAccess')->deleteData($group_map);
		return $result;
	}
	
	
	
	
	
	
}