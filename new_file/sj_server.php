<?php

class DES
{
    var $key;
    var $iv; //偏移量

    function DES( $key, $iv=0 ) {
        //key长度8例如:1234abcd
        $this->key = $key;
        if( $iv == 0 ) {
            $this->iv = $key;
        } else {
            $this->iv = $iv; //mcrypt_create_iv ( mcrypt_get_block_size (MCRYPT_DES, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM );
        }
    }

    function encrypt($str) {
        //加密，返回大写十六进制字符串
        $size = mcrypt_get_block_size ( MCRYPT_DES, MCRYPT_MODE_CBC );
        $str = $this->pkcs5Pad ( $str, $size );
        return strtoupper( bin2hex( mcrypt_cbc(MCRYPT_DES, $this->key, $str, MCRYPT_ENCRYPT, $this->iv ) ) );
    }

    function decrypt($str) {
        //解密
        $strBin = $this->hex2bin( strtolower( $str ) );
        $str = mcrypt_cbc( MCRYPT_DES, $this->key, $strBin, MCRYPT_DECRYPT, $this->iv );
        $str = $this->pkcs5Unpad( $str );
        return $str;
    }

    function hex2bin($hexData) {
        $binData = "";
        for($i = 0; $i < strlen ( $hexData ); $i += 2) {
            $binData .= chr ( hexdec ( substr ( $hexData, $i, 2 ) ) );
        }
        return $binData;
    }

    function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen ( $text ) % $blocksize);
        return $text . str_repeat ( chr ( $pad ), $pad );
    }

    function pkcs5Unpad($text) {
        $pad = ord ( $text {strlen ( $text ) - 1} );
        if ($pad > strlen ( $text ))
            return false;
        if (strspn ( $text, chr ( $pad ), strlen ( $text ) - $pad ) != $pad)
            return false;
        return substr ( $text, 0, - 1 * $pad );
    }
}




//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("120.26.68.72", 9505);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    echo "server: handshake success with fd{$request->fd}\n";//$request->fd 是客户端id
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $str = $frame->data;
    $key = '1234abcs';
    $crypt = new DES($key);
    $str = $crypt->encrypt($str);
//    $ws->push($i, $data );
    $ws->push($frame->fd, $str);//$frame->fd 是客户端id，$frame->data是客户端发送的数据
    //服务端向客户端发送数据是用 $server->push( '客户端id' ,  '内容')
});


//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();