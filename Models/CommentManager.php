<?php
require_once 'Manager.php';

class CommentManager extends Manager
{

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
			FROM comments WHERE post_id = ?');
        $req->execute([$postId]);

        return $req;
    }

    public function reportComment($id, $userReport)
    {
        $safeId = htmlspecialchars($id);
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = (comments.reported +1),report_users = :userReport WHERE id = :id');
        $req->execute([':id' => $safeId, ':userReport' => $userReport]);

    }

    public function getReportUsers($id)
    {
        $safeId = htmlspecialchars($id);
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT report_users FROM comments WHERE id = ?');
        $req->execute([$safeId]);
        $result = $req->fetch();
        var_dump($result[0]);
        return explode(',', $result[0]);


    }

}