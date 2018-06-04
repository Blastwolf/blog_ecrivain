<?php

class CommentManager extends Manager{

    public function getComments($postId){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
			FROM comments WHERE post_id = ?');
		$req->execute([$postId]);

		return $req;
	}
}