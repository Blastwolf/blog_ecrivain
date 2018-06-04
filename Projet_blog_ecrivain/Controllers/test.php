<?php
require_once 'Models/PostManager.php';

function testdeouf()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require 'Views/viewPostsList.php';
}