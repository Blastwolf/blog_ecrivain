<?php
require_once 'Manager.php';

class CommentManager extends Manager
{

    public function getComment($commentId)
    {
        $req = $this->db->prepare('SELECT * FROM comments WHERE id = ? ');
        $req->execute([$commentId]);

        return $req->fetch();
    }

    public function getComments($postId)
    {
        $req = $this->db->prepare('SELECT id, post_id, author, content, reported, report_users ,DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr
			FROM comments WHERE post_id = ? AND reported < 2 ORDER BY creation_date ASC');
        $req->execute([$postId]);

        return $req;
    }

    public function postComment($postId, $author, $content)
    {
        $contentSafe = htmlspecialchars($content);
        $req = $this->db->prepare('INSERT INTO comments(post_id, author, content)VALUES(?,?,?)');
        $req->execute([$postId, $author, $contentSafe]);
    }

    public function deleteComment($commentId)
    {
        $req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute([$commentId]);

    }

    //method pour la suppression des commentaires lié a un post lorsque l'on supprime le post
    public function deleteCommentsFromPost($postId)
    {
        $req = $this->db->prepare('DELETE FROM comments WHERE post_id = ?');
        $req->execute([$postId]);

    }

    public function updateComment($commentId, $commentContent)
    {
        $commentContentSafe = htmlspecialchars($commentContent);
        $req = $this->db->prepare('UPDATE comments SET content = :content , reported = 0,report_users = NULL WHERE id = :id');
        $req->execute([':content' => $commentContentSafe, ':id' => $commentId]);
    }

    public function reportComment($id, $userReport)
    {
        $req = $this->db->prepare('UPDATE comments SET reported = (comments.reported +1),report_users = :userReport WHERE id = :id');
        $req->execute([':id' => $id, ':userReport' => $userReport]);

    }

    public function getReportUsers($id)
    {
        $req = $this->db->prepare('SELECT report_users FROM comments WHERE id = ?');
        $req->execute([$id]);
        $result = $req->fetch();
        return explode(',', $result[0]);

    }

    public function getReportedComments($startIndex)
    {
        $req = $this->db->prepare('SELECT * FROM comments WHERE reported >=1 ORDER BY reported DESC LIMIT :start,5');
        $req->bindParam(':start', $startIndex, PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function countComment()
    {
        $req = $this->db->query('SELECT COUNT(*) FROM comments WHERE reported >= 1');
        return $req->fetchColumn();
    }

}