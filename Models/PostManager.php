<?php
require_once 'Manager.php';

class PostManager extends Manager
{

    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id,title,content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\')
                            AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0,5');
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT id,title,content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\')
                            AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute([$postId]);

        $post = $req->fetch();
        return $post;
    }

    public function updatePost($title, $content, $postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :title,content = :content,creation_date = CURRENT_TIMESTAMP() WHERE id = :id');
        $req->execute([':title' => $title, ':content' => $content, ':id' => $postId]);
        return $req;
    }

}