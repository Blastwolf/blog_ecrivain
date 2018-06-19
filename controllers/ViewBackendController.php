<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';
require_once ROOT . '/models/ImageManager.php';

class ViewBackendController
{
    private $nbTotalPostPage;
    private $nbTotalCommentPage;
    private $postManager;
    private $commentManager;
    private $ImageManager;
    private $currentPageNumberPost;
    private $currentPageNumberComment;
    private $message;
    private $error;


    function __construct($currentPageNumberPost = 1, $currentPageNumberComment = 1)
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->ImageManager = new ImageManager();
        $this->currentPageNumberPost = ($currentPageNumberPost - 1) * 4;
        $this->currentPageNumberComment = ($currentPageNumberComment - 1) * 5;

        $this->nbTotalPostPage = ceil($this->postManager->countPost() / 4);
        $this->nbTotalCommentPage = ceil($this->commentManager->countComment() / 5);
    }


    public function showBackend()
    {
        $posts = $this->postManager->getPosts($this->currentPageNumberPost, 'DESC');
        $comments = $this->commentManager->getReportedComments($this->currentPageNumberComment);

        require ROOT . '/views/backend/viewBackend.php';
    }


    public function showEditPost($postId)
    {
        $post = $this->postManager->getPost($postId);
        $comments = $this->commentManager->getComments($postId);
        require ROOT . '/views/backend/viewEditPost.php';
    }

    public function showAddPost()
    {
        require ROOT . '/views/backend/viewAddPost.php';
    }

    public function addPost($title, $content, $image_name)
    {
        $isUploadSuccess = $this->ImageManager->uploadImage();
        if ($isUploadSuccess == 'success') {
            $imageChangedName = $this->ImageManager->getImageName();
            $this->postManager->addPost($title, $content, $imageChangedName);
            $this->message = 'Episode ajouté avec succé !';
            $this->showBackend();

        } else {
            $this->error = $isUploadSuccess;
            require ROOT . '/views/backend/viewAddPost.php';
        }
    }


    public function updatePost($title, $content, $image_name, $postId)
    {
        //on recupere le post pour pouvoir supprimer l'image déjà en place si il y en a une
        $post = $this->postManager->getPost($postId);
        $isUploadSuccess = $this->ImageManager->uploadImage();
        //si on ajoute pas d'image dans la page d'édition , on laisse l'image déjà en place et on update le post
        if ($image_name == null) {
            $this->postManager->updatePost($title, $content, $post['image_name'], $postId);
            $this->message = 'Episode modifié avec succé !';
            $this->showBackend();
            //sinon on upgrade l'image avec la nouvelle et on update le post
        } elseif ($isUploadSuccess == 'success') {
            $this->ImageManager->deleteImage($post['image_name']);
            //on upload la nouvelle image et les modif du post
            $imageChangedName = $this->ImageManager->getImageName();
            $this->postManager->updatePost($title, $content, $imageChangedName, $postId);
            $this->message = 'Episode modifié avec succé !';
            $this->showBackend();

        } else {
            $this->error = $isUploadSuccess;
            require ROOT . '/views/backend/viewEditPost.php';
        }

    }

    public function deletePost($postId)
    {
        $post = $this->postManager->getPost($postId);
        $this->postManager->deletePost($postId);
        $this->ImageManager->deleteImage($post['image_name']);
        $this->commentManager->deleteCommentsFromPost($postId);
        $this->message = 'Episode supprimé !';
        $this->showBackend();
    }

    public function showEditComment($commentId)
    {

        $posts = $this->postManager->getPosts($this->currentPageNumberPost);
        $comments = $this->commentManager->getReportedComments($this->currentPageNumberComment);
        $moderateComment = $this->commentManager->getComment($commentId);

        require ROOT . '/views/backend/viewBackend.php';
    }


    public function moderateComment($commentId, $commentContent)
    {
        $this->commentManager->updateComment($commentId, $commentContent);
        $this->messageCom = 'Le commentaire à bien était modéré ';
        $this->showBackend();
    }

    public function deleteComment($commentId)
    {
        $this->commentManager->deleteComment($commentId);
        $this->messageCom = 'Le commentaire à bien était supprimé';
        $this->showBackend();
    }
}