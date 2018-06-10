<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewBackendController
{


    public static function showBackend($currentPageNumberPost, $currentPageNumberComment)
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $currentPagePost = ($currentPageNumberPost - 1) * 5;
            $currentPageComment = ($currentPageNumberComment - 1) * 5;

            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $posts = $postManager->getPosts($currentPagePost);
            $comments = $commentManager->getReportedComments($currentPageComment);
            $nbComments = $commentManager->countPost();
            $nbPosts = $postManager->countPost();
            $nbTotalCommentPage = ceil($nbComments / 5);
            $nbTotalPostPage = ceil($nbPosts / 5);
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

    public static function showAddPost()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
            require ROOT . '/views/backend/viewAddPost.php';
        } else {
            echo 'Vous n\'avez pas les droits requis';
        }
    }

    public static function addPost($title, $content)
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
            $postManager = new PostManager();
            $postManager->addPost($title, $content);
            self::showBackend();
        } else {
            echo 'Vous n\'avez pas les droits requis';
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

    public static function deletePost($postId)
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
            $postManager = new PostManager();
            $postManager->deletePost($postId);
            self::showBackend();
        } else {
            echo 'Vous n\'avez pas les droits requis';
        }
    }

    public static function showEditComment($commentId)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $posts = $postManager->getPosts();
        $comments = $commentManager->getReportedComments();
        $moderateComment = $commentManager->getComment($commentId);
        require ROOT . '/views/backend/viewBackend.php';
    }

    public static function moderateComment($commentId, $commentContent)
    {
        $commentManager = new CommentManager();
        $commentManager->updateComment($commentId, $commentContent);
        self::showBackend();
    }
}