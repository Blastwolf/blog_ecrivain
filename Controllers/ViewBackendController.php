<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewBackendController
{


    public static function showBackend()
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $posts = $postManager->getPosts();
            $comments = $commentManager->getReportedComments();
            require ROOT . '/views/backend/viewBackend.php';
        } else {
            echo 'Vous n\'avez pas accés à cette page <a href="index.php">Retourner à la page d\'Accueil</a>';
        }
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

    public static function updatePost($title, $content, $postId)
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $postManager = new PostManager();
            $postManager->updatePost($title, $content, $postId);
            ViewBackendController::showBackend();
            echo 'la news a bien etait update';
        }
    }
}