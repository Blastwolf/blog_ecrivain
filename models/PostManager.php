<?php
require_once 'Manager.php';

class PostManager extends Manager
{


    public function getPosts($start, $order = null)
    {
        if ($order == null) {
            $req = $this->db->prepare('SELECT id,title,content,image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts ORDER BY creation_date ASC LIMIT :start, 4');
        } else {
            $req = $this->db->prepare('SELECT id,title,content,image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
                            AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :start, 4');
        }
        $req->bindParam(':start', $start, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->db->prepare('SELECT id,title,content,image_name, DATE_FORMAT(creation_date, \'%d/%m/%Y\')
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

    public function addPost($title, $content, $image_name)
    {
        $req = $this->db->prepare('INSERT INTO posts (title,content,image_name)VALUES(:title,:content,:image_name)');
        $req->execute([':title' => $title, ':content' => $content, ':image_name' => $image_name]);

    }

    public function updatePost($title, $content, $image_name, $postId)
    {
        $req = $this->db->prepare('UPDATE posts SET title = :title,content = :content ,image_name = :image_name WHERE id = :id');
        $req->execute([':title' => $title, ':content' => $content, ':image_name' => $image_name, ':id' => $postId]);
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