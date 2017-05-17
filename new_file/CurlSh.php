<?php
header('Content-type:text/html;charset=utf-8');
ini_set("max_execution_time", "6400");
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
        $pdo = new PDO($dsn,'root','389586');
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
        return $this->pdo->lastInsertId();
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


//处理是否找到内容
function connect($url){
	$obj = new Curl;
    $str = $obj->get($url);
	return $str;
}


$data = "a:3:{s:10:\"f_province\";s:6:\"北京\";s:6:\"f_city\";s:6:\"北京\";s:3:\"url\";s:25:\"http://newhouse.fang.com/\";}";
$data = unserialize($data);
information($data);
function information($data){
    $module = new Model();
    $select_province = "SELECT f_id FROM cm_province WHERE f_name like '%{$data['f_province']}%'";
    $province = $module->q($select_province);//省份id
    $select_city = "SELECT f_id FROM cm_city WHERE f_name like '%{$data['f_city']}%'";
    $city = $module->q($select_city);//城市id
    $url = get_year_moth($data);
    $obj = new Curl();
    foreach ($url as $v){
        $page_url = get_url($v);
        foreach ($page_url as $key=>$value){
            $str = connect($value);
            $matchs = array();
            //正则匹配数据
            preg_match_all('/<ul\sclass="clearfix">[\S\s]*?<\/ul>/',$str,$matchs);
            //实例化PDO类
            $model = new Model;
            if(!empty($matchs[0])){
                preg_match_all('/<li>[\S\s]*?<\/li>/',implode($matchs[0]),$building_info);
                if(!empty($building_info[0])){
                    foreach ($building_info[0] as $k => $v) {
                        $building = info($v);
                        if(empty($building['exploit'])){
                           continue;
                        }
//                        print_r($building);
                        $sql = "INSERT INTO cm_developer SET f_name='{$building['exploit']['f_name']}',f_address='{$building['exploit']['f_address']}',f_telphone='{$building['exploit']['f_telphone']}',f_description='{$building['exploit']['content']}'";
                        $id = $module->e($sql);
                        if($id){
                            $area_sql = "SELECT f_id FROM cm_area WHERE f_city_id = {$city[0]['f_id']} AND f_name LIKE '%{$building['region']}%'";
                            $area = $module->q($area_sql);//区域id
                            if(!empty($area[0]['f_id'])){
                                $area_id = $area[0]['f_id'];
                            }else{
                                $area_id = 0;
                            }
                            $year = substr(substr(substr($value,-10),0,6),0,4);
                            $month = substr(substr(substr($value,-10),0,6),-2);
                            $time = strtotime("{$year}-{$month}");//发布时间
                            $building_sql = "INSERT INTO cm_building SET f_name='{$building['f_name']}',f_address='{$building['f_address']}',f_province_id={$province[0]['f_id']},f_city_id={$city[0]['f_id']},f_area_id={$area_id},f_developer_id={$id},f_public_time={$time},f_open_time='{$building['f_open_time']}',f_coordx='{$building['exploit']['f_coordx']}',f_coordy='{$building['exploit']['f_coordy']}'";
                            $id = $module->e($building_sql);
                        }

                    }
                }
            }
        }
    }
}

//处理年份和月份的url
function get_year_moth($data){
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

        $url[] = $data['url']."house/saledate/".$num.".htm";
    }while($num <= 201611);
    return $url;
}

//获取页面和分页的地址
function get_url($url){
    $urlData[0] = $url;

    $str = connect($urlData[0]);
    //正则匹配数据
    preg_match_all('/<ul\sclass="clearfix">[\S\s]*?<\/ul>/',$str,$matchs);
    //	分页
    if(!empty($matchs[0][1])){
        preg_match_all('/<a\shref="([\S\s]*?)">[\S\s]*?<\/a>/',$matchs[0][1],$data);
        if(!empty($data[1])){
            foreach ($data[1] as $v) {
                $tmp = $urlData[0];
                $end = strstr($tmp,".com");
                $page_url = str_replace($end,".com".$v,$tmp);
                $urlData[] = $page_url;
            }
        }
    }
//    放回
    return $urlData;
}


/**
 * 查找出数据的信息
 */
function info($data){
    preg_match_all('/<div class="img">[\S\s]*?<\/a>/',$data,$urlDiv);//地图地址
    if(!empty($urlDiv[0][0])){
        preg_match_all('/<a href="(.*?)" target="_blank">[\S\s]*?<\/a>/',$urlDiv[0][0],$url_a);//地图地址
        if(!empty($url_a[1][0])){
            $exploit_data = map_url($url_a[1][0]);
        }

    }
    preg_match_all('/<p class="address">[\S\s]*?>([\S\s]*?)<\/a><\/p>/',$data,$f_address);
    if(!empty($f_address[1][0])){
        $datas['f_address'] = $f_address[1][0];//地址
    }else{
        $datas['f_address'] = "";
    }
//  正则匹配数据
    preg_match_all('/<a\shref="(.*?)"\starget="_blank"\sclass="floatl\sw130">([\S\s]*?)<\/a>/',$data,$f_name);//楼盘名称
    if(!empty($f_name[2][0])){
        $datas['f_name'] = $f_name[2][0];//楼盘名称
    }else{
        $datas['f_name'] = "";
    }
    preg_match_all('/<span\sclass="floatr">\[([\S\s]*?)\]<\/span>/',$data,$region);//地区
    if(!empty($region[1][0])){
        $datas['region'] = $region[1][0];//地区
    }else{
        $datas['region'] = "";
    }
    preg_match_all('/<a href=".*?" class="open-time" target="_blank">([\S\s]*?)<\/a>/',$data,$open_time);//开盘时间
    if(!empty($open_time[1][0])){
        $datas['f_open_time'] = $open_time[1][0];//开盘时间
    }else{
        $datas['f_open_time'] = "";
    }
    $datas['exploit'] = $exploit_data;
    return $datas;
}

//取出地图坐标和开发商信息
//取出地图地址
function map_url($map_url){

    $obj = new Curl();
    $str = $obj->get($map_url);
    if(!$str){
        return '';
    }
//    正则匹配地图地址
    preg_match_all('/<div class="mapbox_dt"  id="map_box">[\S\s]*?<\/div>/',$str,$mapdiv);
//    如果存在取出url地址
    if(!empty($mapdiv[0])){
        preg_match_all('/<iframe id="iframe_map" src="([\S\s]*?)"[\S\s]*?>/',implode($mapdiv[0]),$maprul);
        if(!empty($maprul[1][0])){
            $map_add = $maprul[1][0];
        }
    }else{
        preg_match_all('/<iframe id="iframe_map" src="([\S\s]*?)"[\S\s]*?>/',$str,$maprul);
        if(!empty($maprul[1][0])){
            $map_add = $maprul[1][0];
        }else{
            $map_add = "";
        }
    }
    $exploit_data = developer($str);
//    检测是否存在地址
    if(!empty($map_add) && !empty($exploit_data)){
        //  取出地图的坐标
        $str = $obj->get($map_add);
        //    正则匹配地图坐标
        preg_match_all('/"baidu_coord_x":"([\S\s]*?)",/',$str,$x);
        preg_match_all('/"baidu_coord_y":"([\S\s]*?)",/',$str,$y);
//        print_r($x);
        if(!empty($x[1][0])){
            $exploit_data['f_coordx'] = $x[1][0];
        }else{
            $exploit_data['f_coordx'] = "";
        }
        if(!empty($y[1][0])){
            $exploit_data['f_coordy'] = $y[1][0];
        }else{
            $exploit_data['f_coordy'] = "";
        }

        return $exploit_data;
    }else{
        return "";
    }
}


//开发商信息
function developer($str){
    $data = array();
    //    开发商信息
    preg_match_all('/<div class="navleft tf" id="orginalNaviBox">[\S\s]*?<\/div>/',$str,$sale_details);
//    找出楼盘详情地址
    if(!empty($sale_details[0][0])){
        preg_match_all('/<a\shref="(.*?)" id=".*?">([\S\s]*?)<\/a>/',$sale_details[0][0],$details_info);
        if(!empty($details_info[2])){
            foreach ($details_info[2] as $k=>$v){
                if($v == "楼盘详情"){
                    $details_url = $details_info[1][$k];
                }
            }
        }
    }
    if(!empty($details_url)){
        $obj = new Curl();
        $str = $obj->get($details_url);
        //第一种结果
        preg_match_all('/<strong>开发商:<\/strong><a href="(.*?)" target="_blank">([\S\s]*?)<\/a>/',$str,$exploit);
        if(!empty($exploit[1][0])){
            $exploit_url = $exploit[1][0];
        }else{
//          第二种结果
            preg_match_all('/<div class="list-left">开<[\S\s]*?<\/li>/',$str,$exploit_info);
            if(!empty($exploit_info[0][0])){
                preg_match_all('/<a href="(.*?)" target="_blank">([\S\s]*?)<\/a>/',$exploit_info[0][0],$exploit);
                if(!empty($exploit[1][0])){
                    $exploit_url = $exploit[1][0];
                }
            }
        }
//        地址
        preg_match_all('/<div class="list-left">楼盘地址：<\/div>[\S\s]*?<div class="list-right-text">(.*?)<\/div>/',$str,$exploit_address);
        if(!empty($exploit_address[1][0])){
            $address = $exploit_address[1][0];
        }else{
            preg_match_all('/<strong>物业地址<\/strong>([\S\s]*?)</',$str,$exploit_address);
            if(!empty($exploit_address[1][0])){
                $address = $exploit_address[1][0];
            }
        }
        if(!empty($address)){
            $data['f_address'] = $address;//楼盘地址
        }else{
            $data['f_address'] = "";
        }
//        联系电话
        preg_match_all('/<div class="list-left">售楼电话：<\/div>[\S\s]*?<div class="list-right c00">(.*?)<\/div>/',$str,$exploit_phone);
        if(!empty($exploit_phone[1][0])){
            $phone = $exploit_phone[1][0];
        }else{
            $phone = "";
        }
        $data['f_telphone'] = $phone;

        if(!empty($exploit_url)){
            $data['f_name'] = $exploit[2][0];//开发商名称
            $exploit_str = $obj->get($exploit_url);

            preg_match_all('/<p><span.*?>.*?<\/span>.*?<\/p>/',$exploit_str,$exploit_content);
            if(!empty($exploit_content[0])){
                $content = "";
                foreach ($exploit_content[0] as $v){
                    $content.=$v;
                }
                $data['content'] =  $content;
            }else{
                $data['content'] =  "<p>暂无资料</p>";
            }
        }
    }
    return $data;
}
