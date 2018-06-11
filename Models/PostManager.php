<?php
require_once 'Manager.php';

class PostManager extends Manager
{

    public function getPosts($start)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id,title,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :start, 4');
        $req->bindParam(':start', $start, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbconnect();
        $req = $db->prepare('SELECT id,title,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute([$postId]);

        $post = $req->fetch();
        return $post;
    }

    public function getLastPost()
    {
        $db = $this->dbconnect();
        $req = $db->query('SELECT *,MAX(id), DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts');
        return $req->fetch();
    }

    public function addPost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title,content)VALUES(:title,:content)');
        $req->execute([':title' => $title, ':content' => $content]);

    }

    public function updatePost($title, $content, $postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :title,content = :content,creation_date = CURRENT_TIMESTAMP() WHERE id = :id');
        $req->execute([':title' => $title, ':content' => $content, ':id' => $postId]);
        return $req;
    }

    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');
        $req->execute([':id' => $postId]);
    }

    public function countPost()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) FROM posts');
        return $req->fetchColumn();
    }
}