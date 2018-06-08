<?php
require_once 'models/PostManager.php';
require_once 'models/CommentManager.php';
require_once 'models/ConnectRegisterManager.php';

//function showPosts()
//{
//    $postManager = new PostManager();
//    $posts = $postManager->getPosts();
//    require ROOT . '/views/viewPostsList.php';
//}
//
//function showPost($postId)
//{
//    $postManager = new PostManager();
//    $commentManager = new CommentManager();
//    $post = $postManager->getPost($postId);
//    $comments = $commentManager->getComments($postId);
//    require ROOT . '/views/viewPost.php';
//}
//
//function showEditPost($postId)
//{
//    if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
//        $postManager = new PostManager();
//        $commentManager = new CommentManager();
//        $post = $postManager->getPost($postId);
//        $comments = $commentManager->getComments($postId);
//        require ROOT . '/views/backend/viewEditPost.php';
//    } else {
//        echo 'Vous n\'avez pas accés à cette page <a href="index.php">Retourner à la page d\'Accueil</a>';
//    }
//}

function updatePost($title, $content, $postId)
{
    if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
        $postManager = new PostManager();
        $postManager->updatePost($title, $content, $postId);
        showBackend();
        echo 'la news a bien etait update';
    }

}

function showConnect()
{
    require ROOT . '/views/viewConnectRegister.php';
}

function showAccueil()
{
    require ROOT . '/views/viewAccueil.php';
}

function showBackend()
{
    if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require ROOT . '/views/backend/viewBackend.php';
    } else {
        echo 'Vous n\'avez pas accés à cette page <a href="index.php">Retourner à la page d\'Accueil</a>';
    }
}


function connectUser($userName, $password)
{
    $connectResgisterManager = new ConnectRegisterManager();
    $result = $connectResgisterManager->connectUser($userName, $password);
    $isPasswordCorrect = password_verify($password, $result['pass']);
    if ($isPasswordCorrect && $connectResgisterManager->validUser($userName)) {
        $_SESSION['user'] = $userName;
        require ROOT . '/views/viewAccueil.php';

    } else {
        echo('test comprend pas');
        $messCon = 'invalide utilisateur password';
        require ROOT . '/views/viewConnectRegister.php';
    }

}

//function deconnectUser()
//{
//    $_SESSION = [];
//    session_destroy();
//
//}
//
//
//function addUsers($userName, $pass, $verif_pass)
//{
//    $userNameSafe = htmlspecialchars($userName);
//    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
//    $verif_pass_hash = password_verify($verif_pass, $pass_hash);
//
//    if (isset($userName) && ($verif_pass_hash)) {
//        $connectResgisterManager = new ConnectRegisterManager();
//        /*--------On test si le pseudo est deja prit------------*/
//        if (!$connectResgisterManager->validUser($userNameSafe)) {
//            $connectResgisterManager->addUser($userNameSafe, $pass_hash);
//            require ROOT . '/views/viewAccueil.php';
//        } else {
//            $messReg = 'Cet nom d\'utilisateur est déjà prit';
//            require ROOT . '/views/viewConnectRegister.php';
//        }
//    } else {
//        $messReg = 'Mot de passe différents';
//        require ROOT . '/views/viewConnectRegister.php';
//    }
//

//}