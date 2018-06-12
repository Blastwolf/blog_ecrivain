<?php
require_once 'Manager.php';

class PostManager extends Manager
{


    public function getPosts($start)
    {
        $req = $this->db->prepare('SELECT id,title,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :start, 4');
        $req->bindParam(':start', $start, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->db->prepare('SELECT id,title,content, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute([$postId]);

        $post = $req->fetch();
        return $post;
    }

    public function getLastPost()
    {
        $req = $this->db->query('SELECT *, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts ORDER BY creation_date LIMIT 1');
        return $req->fetch();
    }

    public function addPost($title, $content)
    {
        $req = $this->db->prepare('INSERT INTO posts (title,content)VALUES(:title,:content)');
        $req->execute([':title' => $title, ':content' => $content]);

    }

    public function updatePost($title, $content, $postId)
    {
        $req = $this->db->prepare('UPDATE posts SET title = :title,content = :content,creation_date = CURRENT_TIMESTAMP() WHERE id = :id');
        $req->execute([':title' => $title, ':content' => $content, ':id' => $postId]);
        return $req;
    }

    public function deletePost($postId)
    {
        $req = $this->db->prepare('DELETE FROM posts WHERE id = :id');
        $req->execute([':id' => $postId]);
    }

    public function countPost()
    {
        $req = $this->db->query('SELECT COUNT(*) FROM posts');
        return $req->fetchColumn();
    }
}