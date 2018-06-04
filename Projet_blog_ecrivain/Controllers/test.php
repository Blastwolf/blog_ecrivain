<?php
require_once 'models/PostManager.php';
require_once 'models/CommentManager.php';

function testdeouf()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require 'views/viewPostsList.php';
}

function showPost($postId){
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);
    require 'views/viewPost.php';
}