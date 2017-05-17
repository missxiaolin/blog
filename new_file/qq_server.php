<?php
//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("120.26.68.72", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
//    echo "server: handshake success with fd{$request->fd}\n";//$request->fd 是客户端id
    file_put_contents('./log.txt',$request->fd,true);
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
//    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
//    $ws->push($frame->fd, "this is server");//$frame->fd 是客户端id，$frame->data是客户端发送的数据
    //服务端向客户端发送数据是用 $server->push( '客户端id' ,  '内容')
//    客户端集合
    global $client;
    $data = $frame->data;
    $m = file_get_contents('./log.txt');
    for ($i=1 ; $i<= $m ; $i++) {
        echo PHP_EOL . '  i is  ' . $i .  '  data  is '.$data  . '  m = ' . $m;
        $ws->push($i, $data );
    }
});


//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();