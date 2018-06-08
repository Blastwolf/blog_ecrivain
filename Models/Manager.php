<?php

class Manager
{
    protected $db;

    protected function dbConnect()
    {
        return $this->db = new PDO('mysql:host=localhost;dbname=blog_ecrivain;charset=utf8', 'root', '');

    }

}