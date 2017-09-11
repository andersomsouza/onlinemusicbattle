<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 14:52
 */

namespace Ander\Dao;


use mysqli;

class ConnectionFactory
{
    private static $instance = null;
    private $servername = "localhost";
    private $username = "homestead";
    private $password = "secret";
    private $db= "homestead";

    public static function getInstance(){
        if(is_null(self::$instance)){
            $instance = new ConnectionFactory();
        }
        return $instance;
    }

    public function getConnection(){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}