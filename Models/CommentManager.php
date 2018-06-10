<?php
require_once 'Manager.php';

class CommentManager extends Manager
{
    function __construct()
    {
        $this->db = $this->dbConnect();
    }


    public function getComment($commentId)
    {
        $req = $this->db->prepare('SELECT * FROM comments WHERE id = ? ');
        $req->execute([$commentId]);

        return $req->fetch();
    }

    public function getComments($postId)
    {
        $req = $this->db->prepare('SELECT id, post_id, author, content, reported, report_users ,DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
			FROM comments WHERE post_id = ? ORDER BY creation_date ASC');
        $req->execute([$postId]);

        return $req;
    }

    public function postComment($postId, $author, $content)
    {
        $req = $this->db->prepare('INSERT INTO comments(post_id, author, content)VALUES(?,?,?)');
        $req->execute([$postId, $author, $content]);
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
        var_dump($result[0]);
        return explode(',', $result[0]);

    }

    public function getReportedComments($start)
    {
        $req = $this->db->prepare('SELECT * FROM comments ORDER BY reported DESC LIMIT :start,5');
        $req->bindParam(':start', $start, PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function countPost()
    {
        $req = $this->db->query('SELECT COUNT(*) FROM comments');
        return $req->fetchColumn();
    }

}