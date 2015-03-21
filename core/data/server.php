<?php

require 'vendor/autoload.php';
require 'vendor/react/reactful/core/src/init.php';


$app = function($request,$response){
    //print_r($data);die();
    $init = new core\init($request,$response);
};


//$app = function ($request, $response) {
//    $response->writeHead(200, array('Content-Type' => 'text/plain'));
//    $response->end("Method: ".$request->getMethod(). "\n Path: ".$request->getPath());
//};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();
