<?php

require '../../vendor/autoload.php';
require '../src/init.php';


$app = function ($request, $response) {
    $init = new core\init($request, $response);
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();
