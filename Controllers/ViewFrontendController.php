<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewFrontendController
{


    static public function showPosts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require ROOT . '/views/viewPostsList.php';
    }

    static public function showPost($postId)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $post = $postManager->getPost($postId);
        $comments = $commentManager->getComments($postId);
        require ROOT . '/views/viewPost.php';
    }

    static public function showEditPost($postId)
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $comments = $commentManager->getComments($postId);
            require ROOT . '/views/backend/viewEditPost.php';
        } else {
            echo 'Vous n\'avez pas accés à cette page <a href="index.php">Retourner à la page d\'Accueil</a>';
        }
    }

    public static function showConnect()
    {
        require ROOT . '/views/viewConnectRegister.php';
    }

    public static function showAccueil()
    {
        require ROOT . '/views/viewAccueil.php';
    }

}