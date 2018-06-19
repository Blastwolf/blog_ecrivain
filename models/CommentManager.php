<?php
require_once 'Manager.php';

class CommentManager extends Manager
{

    public function getComment($commentId)
    {
        $commentIdSafe = htmlspecialchars($commentId);
        $req = $this->db->prepare('SELECT * FROM comments WHERE id = ? ');
        $req->execute([$commentIdSafe]);

        return $req->fetch();
    }

    public function getComments($postId)
    {
        $postIdSafe = htmlspecialchars($postId);
        $req = $this->db->prepare('SELECT id, post_id, author, content, reported, report_users ,DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr
			FROM comments WHERE post_id = ? AND reported < 2 ORDER BY creation_date ASC');
        $req->execute([$postIdSafe]);

        return $req;
    }

    public function postComment($postId, $author, $content)
    {
        $postIdSafe = htmlspecialchars($postId);
        $contentSafe = htmlspecialchars($content);
        $req = $this->db->prepare('INSERT INTO comments(post_id, author, content)VALUES(?,?,?)');
        $req->execute([$postIdSafe, $author, $contentSafe]);
    }

    public function deleteComment($commentId)
    {
        $commentIdSafe = htmlspecialchars($commentId);
        $req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute([$commentIdSafe]);

    }

    //method pour la suppression des commentaires lié a un post lorsque l'on supprime le post
    public function deleteCommentsFromPost($postId)
    {
        $postIdSafe = htmlspecialchars($postId);
        $req = $this->db->prepare('DELETE FROM comments WHERE post_id = ?');
        $req->execute([$postIdSafe]);

    }

    public function updateComment($commentId, $commentContent)
    {
        $commentIdSafe = htmlspecialchars($commentId);
        $commentContentSafe = htmlspecialchars($commentContent);
        $req = $this->db->prepare('UPDATE comments SET content = :content , reported = 0,report_users = NULL WHERE id = :id');
        $req->execute([':content' => $commentContentSafe, ':id' => $commentIdSafe]);
    }

    public function reportComment($id, $userReport)
    {
        $safeId = htmlspecialchars($id);
        $req = $this->db->prepare('UPDATE comments SET reported = (comments.reported +1),report_users = :userReport WHERE id = :id');
        $req->execute([':id' => $safeId, ':userReport' => $userReport]);

    }

    public function getReportUsers($id)
    {
        $safeId = htmlspecialchars($id);
        $req = $this->db->prepare('SELECT report_users FROM comments WHERE id = ?');
        $req->execute([$safeId]);
        $result = $req->fetch();
        return explode(',', $result[0]);

    }

    public function getReportedComments($startIndex)
    {
        $startIndexSafe = intval(htmlspecialchars($startIndex));
        $req = $this->db->prepare('SELECT * FROM comments WHERE reported >=1 ORDER BY reported DESC LIMIT :start,5');
        $req->bindParam(':start', $startIndexSafe, PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function countComment()
    {
        $req = $this->db->query('SELECT COUNT(*) FROM comments WHERE reported >= 1');
        return $req->fetchColumn();
    }

}