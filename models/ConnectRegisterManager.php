<?php
require_once 'Manager.php';

class ConnectRegisterManager extends Manager
{


    public function getUserDetails($userName)
    {
        $userNameSafe = htmlspecialchars($userName);
        $req = $this->db->prepare('SELECT userName, pass FROM users WHERE userName = :userName');
        $req->execute([':userName' => $userNameSafe]);

        return $req->fetch();
    }

    public function addUser($userName, $password)
    {
        $userNameSafe = htmlspecialchars($userName);
        $passwordSafe = htmlspecialchars($password);
        $req = $this->db->prepare('INSERT INTO users (userName,pass,creation_date) VALUES (:userName ,:pass, CURRENT_TIMESTAMP())');
        $req->execute(['userName' => $userNameSafe, 'pass' => $passwordSafe]);
    }

    public function validUser($userName)
    {
        $userNameSafe = htmlspecialchars($userName);
        $req = $this->db->prepare('SELECT COUNT(*) FROM users WHERE userName = :userName');
        $req->execute(['userName' => $userNameSafe]);

        return (bool)$req->fetchColumn();

    }
}