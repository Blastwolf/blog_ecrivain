<?php

class Manager
{
    protected $db;

    function __construct()
    {
        $this->db = $this->dbConnect();
    }

    protected function dbConnect()
    {
        return $this->db = new PDO('mysql:host=localhost;dbname=blog_ecrivain;charset=utf8', 'root', '');
    }

}