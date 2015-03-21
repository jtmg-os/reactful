<?php
require 'vendor/autoload.php';
require 'vendor/react/reactful/core/src/init.php';

class restfulInitTest extends \PHPUnit_Framework_TestCase
{
    protected $loop, $socket, $http;

    public function testLoop()
    {
        $this->loop = React\EventLoop\Factory::create();
        $this->assertTrue(is_object($this->loop));
    }

    public function testSocket()
    {
        $this->loop = React\EventLoop\Factory::create();
        $this->socket = new React\Socket\Server($this->loop);
        $this->assertTrue(is_object($this->socket));
    }

    public function testServer()
    {
        $this->loop = React\EventLoop\Factory::create();
        $this->socket = new React\Socket\Server($this->loop);
        $this->http = new React\Http\Server($this->socket, $this->loop);
        $this->assertTrue(is_object($this->http));
    }
}