<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewBackendController
{
    const actualBackendPostPage = 0;

    public static function showBackend($currentPageNumberPost = 1, $currentPageNumberComment = 1)
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $currentPagePost = ($currentPageNumberPost - 1) * 4;
            $currentPageComment = ($currentPageNumberComment - 1) * 5;
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $posts = $postManager->getPosts($currentPagePost);
            $comments = $commentManager->getReportedComments($currentPageComment);
            $nbComments = $commentManager->countPost();
            $nbPosts = $postManager->countPost();
            $nbTotalCommentPage = ceil($nbComments / 5);
            $nbTotalPostPage = ceil($nbPosts / 4);
            echo $nbTotalPostPage . $nbTotalCommentPage;
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
            self::showBackend();
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

    public static function showEditComment($commentId, $currentPageNumberPost, $currentPageNumberComment)
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $currentPagePost = ($currentPageNumberPost - 1) * 4;
            $currentPageComment = ($currentPageNumberComment - 1) * 5;
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $posts = $postManager->getPosts($currentPagePost);
            $comments = $commentManager->getReportedComments($currentPageComment);
            $nbComments = $commentManager->countPost();
            $nbPosts = $postManager->countPost();
            $nbTotalCommentPage = ceil($nbComments / 5);
            $nbTotalPostPage = ceil($nbPosts / 4);
            $moderateComment = $commentManager->getComment($commentId);
            echo('le commentaire avec id :' . $moderateComment['id'] . 'a bien etait moderer');
            require ROOT . '/views/backend/viewBackend.php';
        }
    }

    public static function moderateComment($commentId, $commentContent, $currentPageNumberPost, $currentPageNumberComment)
    {
        $commentManager = new CommentManager();
        $commentManager->updateComment($commentId, $commentContent);
        self::showBackend($currentPageNumberPost, $currentPageNumberComment);
    }
}