<?php
require_once 'Manager.php';

class ConnectRegisterManager extends Manager
{


    public function connectUser($userName, $password)
    {
        $db = $this->dbConnect();

        $userNameSafe = htmlspecialchars($userName);

        $req = $db->prepare('SELECT userName, pass FROM users WHERE userName = :userName');
        $req->execute(['userName' => $userNameSafe]);

        return $req->fetch();
    }

    public function addUser($userName, $password)
    {

        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO users (userName,pass,creation_date) VALUES (:userName ,:pass, CURRENT_TIMESTAMP())');

        $req->execute(['userName' => $userName, 'pass' => $password]);
    }

    public function validUser($userName)
    {

        $db = $this->dbConnect();
        $userNameSafe = htmlspecialchars($userName);

        $req = $db->prepare('SELECT COUNT(*) FROM users WHERE userName = :userName');
        $req->execute(['userName' => $userNameSafe]);

        return (bool)$req->fetchColumn();

    }
}