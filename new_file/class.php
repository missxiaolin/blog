<?php
header('Content-type:text/html;charset=utf-8');
ini_set("max_execution_time", "3600");
/**
 * curl类
 */
class Curl
{

    //请求服务器
    public function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36');
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
//		curl_setopt($ch, CURLOPT_REFERER, $prevUrl);
        $header = array();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        $contentLength = 0;
        if($contentLength<500){
//			长度小于500重新抓取
            $content = curl_exec($ch);//获取网页内容
            $content = iconv("GB2312","UTF-8//IGNORE",$content);
            $contentLength = strlen($content);
        }


        return $content;
    }
}
/**
 * pdo类
 * q方法是查询有结果姐
 * e方法是操作
 */
class Model{
    private $pdo;
    public function __construct(){
        $dsn = 'mysql:host=127.0.0.1;dbname=curl';
        $pdo = new PDO($dsn,'root','');
        $pdo->exec("SET NAMES UTF8");
        $this->pdo = $pdo;
    }
    //执行有结果集的方法
    public function q($sql){
        $re = $this->pdo->query($sql);
        $rows = $re->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    //执行无结果集的方法
    public function e($sql){
        $this->pdo->exec($sql);
    }
}



/**
 * 格式转换
 * $data 传入curl抓取到的数据即可
 */
function characet($data){
    if( !empty($data) ){
        $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
        if( $fileType != 'UTF-8'){
            $data = mb_convert_encoding($data ,'utf-8' , $fileType);
        }
    }
    return $data;
}

/**
 * 查找出数据的信息
 */
function info($data){
//    匹配坐标地址
    preg_match_all('/<div class="img">[\S\s]*?<\/a>/',$data,$urlDiv);//地图地址
    if(!empty($urlDiv[0][0])){
        preg_match_all('/<a href="(.*?)" target="_blank">[\S\s]*?<\/a>/',$urlDiv[0][0],$url_a);//地图地址
        if(!empty($url_a[1][0])){
            $address_url =  $url_a[1][0];
        }

    }
//  正则匹配数据
    preg_match_all('/<a\shref="(.*?)"\starget="_blank"\sclass="floatl\sw130">([\S\s]*?)<\/a>/',$data,$address);//地址
    preg_match_all('/<span\sclass="floatr">([\S\s]*?)<\/span>/',$data,$region);//地区
    preg_match_all('/<div class="price">[\S\s]*?<span>([\S\s]*?)</',$data,$price);	//价格
    $data = array(
        "address"=>$address[2],
        "region"=>$region[1],
        "price"=>$price[1],
        "address_url"=>$address_url
    );
    return $data;
}


//处理是否找到内容
function connect($url){
    $obj = new Curl;
    do{
        $str = $obj->get($url);
        preg_match_all('/<body[\S\s]*?<\/body>/',$str,$data);
    }while(empty($data[0][0]));
    return $str;
}

//查找好了放入数据库
function write($str){

    $matchs = array();
    //正则匹配数据
    preg_match_all('/<ul\sclass="clearfix">[\S\s]*?<\/ul>/',$str,$matchs);
    //实例化PDO类
    $model = new Model;
    if($matchs[0]){
        preg_match_all('/<li>[\S\s]*?<\/li>/',implode($matchs[0]),$data);
        //	正则匹配到的数组存在就进行数据添加
        if($data[0]){
            foreach ($data[0] as $k => $v) {
                $data = info($v);
                $sel = "SELECT * FROM info WHERE address='{$data['address'][0]}' AND region='{$data['region'][0]}' AND price='{$data['price'][0]}'";
                //          避免数组重复判断
                if(!$model->q($sel)){
                    $sql = "INSERT INTO info SET address='{$data['address'][0]}',region='{$data['region'][0]}',price='{$data['price'][0]}',address_url='{$data['address_url']}'";
                    $model->e($sql);
                }

            }
        }

    }
}


//处理年份和月份的url
function get_year_moth(){
    $year = 2013;
    $month = 0;
    $url = array();
    do{
        $month++;
        if(strlen($month)==1){
            $num = intval($year."0".$month);
        }else{
            $num = intval($year.$month);
            if(intval($month)==12){
                $year = $year+1;
                $month = 0;
            }
        }

        $url[] = "http://newhouse.sh.fang.com/house/saledate/".$num.".htm";
    }while($num <= 201611);
    foreach ($url as $v) {
        get_url($v);
    }
}


//获取页面和分页的地址
function get_url($url){
    $urlData[0] = $url;
    $obj = new Curl;
    $str = $obj->get($url);
//    $str = connect($urlData[0]);
//    print_r($str);
//    exit;
    //正则匹配数据
    preg_match_all('/<ul\sclass="clearfix">[\S\s]*?<\/ul>/',$str,$matchs);
    //	分页
    if(!empty($matchs[0][1])){
        preg_match_all('/<a\shref="([\S\s]*?)">[\S\s]*?<\/a>/',$matchs[0][1],$data);
        if(!empty($data[1])){
            foreach ($data[1] as $v) {
                $tmp = $urlData[0];
                $end = strstr($tmp,".com");
//				echo $tmp;
                $page_url = str_replace($end,".com".$v,$tmp);
                $urlData[] = $page_url;
            }
        }
    }
    //最后执行放入数据库
    foreach ($urlData as $v) {
        $str = connect($v);
        write($str);
    }

}
get_year_moth();
//country_address();
// get_url($argv[1]);
// echo $argv[1];





















