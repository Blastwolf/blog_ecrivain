<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewBackendController
{


    public static function showBackend()
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $postManager = new PostManager();
            $posts = $postManager->getPosts();
            require ROOT . '/views/backend/viewBackend.php';
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