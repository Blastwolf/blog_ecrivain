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

function showEditPost($postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);
    require 'views/backend/viewEditPost.php';
}

function showConnect()
{
    require 'views/viewConnectRegister.php';
}

function showAccueil()
{
    require 'views/viewAccueil.php';
}

function showBackend()
{

    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
        require 'views/backend/viewBackend.php';
    }
    echo 'Vous n\'avez pas accés à cette page <a href="index.php">Retourner à la page d\'Accueil</a>';
}


function connectUser($userName, $password)
{
    $connectResgisterManager = new ConnectRegisterManager();
    $result = $connectResgisterManager->connectUser($userName, $password);
    $isPasswordCorrect = password_verify($password, $result['pass']);
    if ($isPasswordCorrect && $connectResgisterManager->validUser($userName)) {
        $_SESSION['user'] = $userName;
        require 'views /viewAccueil.php';

    } else {
        echo('test comprend pas');
        $messCon = 'invalide utilisateur password';
        require 'views /viewConnectRegister.php';
    }

}

function deconnectUser()
{
    $_SESSION = [];
    session_destroy();

}


function addUsers($userName, $pass, $verif_pass)
{
    $userNameSafe = htmlspecialchars($userName);
    echo $userNameSafe;
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $verif_pass_hash = password_verify($verif_pass, $pass_hash);

    if (isset($userName) && ($verif_pass_hash)) {
        $connectResgisterManager = new ConnectRegisterManager();
        /*--------On test si le pseudo est deja prit------------*/
        if (!$connectResgisterManager->validUser($userNameSafe)) {
            $connectResgisterManager->addUser($userNameSafe, $pass_hash);
            require 'views /viewAccueil.php';
        } else {
            $messReg = 'Cet nom d\'utilisateur est déjà prit';
            require 'views/viewConnectRegister.php';
        }
    } else {
        $messReg = 'Mot de passe différents';
        require 'views/viewConnectRegister.php';
    }


}