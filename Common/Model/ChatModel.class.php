<?php 
namespace Common\Model;
use Common\Model\BaseModel;
/**
 *  闲言碎语model
 */
class ChatModel extends BaseModel
{
	// 自动验证
    protected $_validate=array(
        array('content','require','内容必填',0,'',3), // 验证字段必填
    );
    
    // 自动完成
    protected $_auto=array(
        array('date','time',3,'function'), // 对date字段在新增的时候写入当前时间戳
    );
	
//	添加数据
	public function addData(){
		$data = I('post.');
	    if(!$data = $this->create($data)) return false;
		$chid = $this->add($data);
		return $chid;
	}
	
//	修改数据
	public function editData(){
	    $data = I('post.');
	    if(!$data = $this->create($data)) return false;
	    $this->where(array('chid'=>$data['chid']))->save($data);
	    return true;
	}
	
	
//	获取随言碎语
	public function getDataByLid($chid){
        return $this->where(array('chid'=>$chid))->find();
    }
	
	
	
//	传递$map获取count数据
	public function getCountData($map=array()){
	    return $this->where($map)->count();
	}
	
	// 传递is_delete和is_show获取对应数据
    public function getDataByState($is_delete='all',$is_show='all'){
        $is_delete=$is_delete==='all' ? '' : "is_delete=$is_delete";
        $is_show=$is_show==='all' ? '' : "is_show=$is_show";
        $where=trim(trim($is_delete.' and '.$is_show,' '),'and');
        return $this->where($where)->order('date desc')->select();
    }
	
	
}
