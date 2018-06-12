<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewBackendController
{
    private $nbTotalPostPage;
    private $nbTotalCommentPage;
    private $postManager;
    private $commentManager;

    function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();

        $this->nbTotalPostPage = ceil($this->postManager->countPost() / 4);
        $this->nbTotalCommentPage = ceil($this->commentManager->countComment() / 5);
    }


    public function showBackend($currentPageNumberPost = 1, $currentPageNumberComment = 1)
    {
        $currentPagePost = ($currentPageNumberPost - 1) * 4;
        $currentPageComment = ($currentPageNumberComment - 1) * 5;
        //$postManager = new PostManager();
        //$commentManager = new CommentManager();
        $posts = $this->postManager->getPosts($currentPagePost);
        $comments = $this->commentManager->getReportedComments($currentPageComment);
        //$nbComments = $commentManager->countComment();
        //$nbPosts = $postManager->countPost();
        //$nbTotalCommentPage = ceil($nbComments / 5);
        //$nbTotalPostPage = ceil($nbPosts / 4);
        require ROOT . '/views/backend/viewBackend.php';

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

    public function showEditComment($commentId, $currentPageNumberPost, $currentPageNumberComment)
    {
        $currentPagePost = ($currentPageNumberPost - 1) * 4;
        $currentPageComment = ($currentPageNumberComment - 1) * 5;

        $posts = $this->postManager->getPosts($currentPagePost);
        $comments = $this->commentManager->getReportedComments($currentPageComment);
        $moderateComment = $this->commentManager->getComment($commentId);

        require ROOT . '/views/backend/viewBackend.php';
    }


    public function moderateComment($commentId, $commentContent, $currentPageNumberPost, $currentPageNumberComment)
    {
        $this->commentManager->updateComment($commentId, $commentContent);
        $this->showBackend($currentPageNumberPost, $currentPageNumberComment);
    }
}