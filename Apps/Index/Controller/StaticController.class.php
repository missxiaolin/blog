<?php
namespace Index\Controller;
use Think\Controller;
/**
 * 首页
 */

class StaticController extends Controller
{
    public function statics(){
        $type = I('get.type');
        $file_path="words/".$type."/index.html";
        if(file_exists($file_path)){
            if($fp=fopen($file_path,"r")){
                $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
                echo $str;
            }else{
                $this->error('没有权限',U('Index/Index/index'));
            }
        }else{
            $this->error('文件不存在',U('Index/Index/index'));
        }
    }
}