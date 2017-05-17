<?php 
namespace Common\Model;
use Common\Model\BaseModel;
/**
 *  后台用户model
 */
class UsersModel extends BaseModel
{
	// 自动验证
    protected $_validate=array(
        array('username','require','用户名必须填写！',0,'',3), // 验证字段必填
        array('username','','已有该用户！',0,'unique',1), //验证用户是否存在
        array('password','require','密码必须填写！',0,'',1), //验证密码字段
    );
    
    // 自动完成
    protected $_auto=array(
        array('password','md5',3,'function') , // 对password字段在新增的时候使md5函数处理
        array('register_time','time',1,'function'), // 对date字段在新增的时候写入当前时间戳
    );
	
//	添加用户
	public function addData($data){
	    if(!$data = $this->create($data)) return false;
	    $result = $this->add($data);
	    if($result){
	    	if(!empty($data['group_ids'])){
	    		foreach ($data['group_ids'] as $k => $v) {
	    			$group=array(
                            'uid'=>$result,
                            'group_id'=>$v
                            );
                    D('AuthGroupAccess')->addData($group);
	    		}
	    	}
	    }
	    return true;
	}
	
//	修改用户
	public function editData($data){
		if(!$data = $this->create()) return false;
//	           组合where数据条件
		$uid = $data['id'];
		$map = array(
			'id'=>$uid
		);
//		修改用户组(先删除全部在添加)
		D('AuthGroupAccess')->deleteData(array('uid'=>$uid));
//		添加
		foreach ($data['group_ids'] as $k => $v) {
            $group=array(
                'uid'=>$uid,
                'group_id'=>$v
                );
            D('AuthGroupAccess')->addData($group);
        }
//		过滤数据中的单元（去除空值）
        $data = array_filter($data);
//      如果修改密码则MD5
		if(!empty($data['password'])){
			$data['password']=md5($data['password']);
		}
		$this->where($map)->save($data);
		return true;
		
		
	}
	
	
	
	
//	修改密码
	public function changePassword($data){
//		判断新密码是否一致
	    if($data['new_password'] != $data['reg_password']){
	    	$this->error = '新密码不一致';
	    	return false;
	    }
//	   	 判断旧密码是否和数据库相同
		$password = $this->where(array('id'=>$_SESSION['user']['id']))->getField('password');
		if($password != md5($data['old_password'])){
			$this->error = '旧密码错误';
			return false;
		}
//		组合新数据进行修改
		$new_data = array(
			'password'=>md5($data['new_password']),
			'id'=>$_SESSION['user']['id']
		);
		$this->save($new_data);
		return true;
	}
	
	
	
	
}