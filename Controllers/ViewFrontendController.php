<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewFrontendController
{


    static public function showPosts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require ROOT . '/views/viewPostsList.php';
    }

    static public function showPost($postId)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $post = $postManager->getPost($postId);
        $comments = $commentManager->getComments($postId);
        $data = $comments->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_SESSION['user'])) {
            foreach ($data as $key => $value) {
                $tempReportUserArray = $commentManager->getReportUsers($data[$key]['id']);
                if (in_array($_SESSION['user'], $tempReportUserArray)) {
                    ${"messSign" . $data[$key]['id']} = 'Vous avez  signalé ce commentaire';
                }
            }
        }
        require ROOT . '/views/viewPost.php';

    }

    static public function showEditPost($postId)
    {
        if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $post = $postManager->getPost($postId);
            $comments = $commentManager->getComments($postId);
            require ROOT . '/views/backend/viewEditPost.php';
        } else {
            echo 'Vous n\'avez pas accés à cette page <a href="index.php">Retourner à la page d\'Accueil</a>';
        }
    }

    static public function showPostAfterReport($commentId, $postId)
    {
        if (isset($_SESSION['user'])) {
            $commentManager = new CommentManager();
            $tempReportUserArray = $commentManager->getReportUsers($commentId);
            if (!in_array($_SESSION['user'], $tempReportUserArray)) {
                $tempReportUserArray[] = $_SESSION['user'];
                echo $_SESSION['user'];
                $reportUserArray = implode(',', $tempReportUserArray);
                print_r($reportUserArray);
                echo $commentId;
                $commentManager->reportComment($commentId, $reportUserArray);
            }
            self::showPost($postId);
        }
    }

    static public function showPostAfterPostComment($postId, $author, $content)
    {
        if (isset($_SESSION['user'])) {
            $commentManager = new CommentManager();
            $commentManager->postComment($postId, $author, $content);
            self::showPost($postId);
        }
    }

    public static function showConnect()
    {
        require ROOT . '/views/viewConnectRegister.php';
    }

    public static function showAccueil()
    {
        require ROOT . '/views/viewAccueil.php';
    }

}