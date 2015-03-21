<?php
/**
 * Created by PhpStorm.
 * User: jacektrefon
 * Date: 10/03/15
 * Time: 21:37
 */

namespace core;


class db {
//@TODO this is to be moved to config folder of the app
protected $user = 'root';
protected $password = 'root';
protected $db = 'ca';
protected $host = '127.0.0.1';
protected $port = 8889;
protected $socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';
protected $link;

    public function __construct()
    {
        $this->link = mysqli_init();
        $this->init();
        return $this;
    }

    public function init()
    {
        return mysqli_real_connect(
            $this->link,
            $this->host,
            $this->user,
            $this->password,
            $this->db,
            $this->port,
            $this->socket
        );
    }

    public function getLink()
    {
        return $this->link;
    }
}