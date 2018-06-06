<?php
require_once 'models/PostManager.php';
require_once 'models/CommentManager.php';
require_once 'models/ConnectRegisterManager.php';

function showPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require 'views/viewPostsList.php';
}

function showPost($postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);
    require 'views/viewPost.php';
}

function showConnect()
{
    require 'views/viewConnectRegister.php';
}

function showAccueil()
{
    require 'views/viewAccueil.php';
}


function connectUser($userName, $password)
{
    $connectResgisterManager = new ConnectRegisterManager();
    $result = $connectResgisterManager->connectUser($userName, $password);
    $isPasswordCorrect = password_verify($password, $result['pass']);
    if ($isPasswordCorrect && $connectResgisterManager->validUser($userName)) {
        $_SESSION['user'] = $userName;
        require 'views/viewAccueil.php';

    } else {
        echo('test comprend pas');
        $messCon = 'invalide utilisateur password';
        require 'views/viewConnectRegister.php';
    }

}

function isValid($userName)
{
    $connectResgisterManager = new ConnectRegisterManager();


}

function addUsers($userName, $pass)
{
    $connectResgisterManager = new ConnectRegisterManager();
    /*--------On test si le pseudo est deja prit------------*/
    if (!$connectResgisterManager->validUser($userName)) {
        $connectResgisterManager->addUser($userName, $pass);
        require 'views/viewAccueil.php';
    } else {
        $messReg = 'Cet nom d\'utilisateur est déjà prit';
        require 'views/viewConnectRegister.php';
    }


}