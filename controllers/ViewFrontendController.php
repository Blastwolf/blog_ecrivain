<?php
require_once ROOT . '/models/PostManager.php';
require_once ROOT . '/models/CommentManager.php';

class ViewFrontendController
{
    private $postManager;
    private $commentManager;
    private $message;


    function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }


    public function showPosts($currentPageNumber = 1)
    {
        $currentPage = ($currentPageNumber - 1) * 4;
        $posts = $this->postManager->getPosts($currentPage);
        $nbPosts = $this->postManager->countPost();
        $nbTotalPages = ceil($nbPosts / 4);
        require ROOT . '/views/viewPostsList.php';
    }

    public function showPost($postId)
    {
        $post = $this->postManager->getPost($postId);
        $comments = $this->commentManager->getComments($postId);
        $data = $comments->fetchAll(PDO::FETCH_ASSOC);
        //Si l'utilisateur est connecté on vérifie si il fait partie des personnes qui on signalé un commentaire , si oui on lui dit qu'il à signalé le commentaire
        if (isset($_SESSION['user'])) {
            foreach ($data as $value) {
                $tempReportUserArray = $this->commentManager->getReportUsers($value['id']);
                if (in_array($_SESSION['user'], $tempReportUserArray)) {
                    //On cree une variable dynamique qui se crée avec l'id du comment qui contient le nom de l'utilisateur dans sont tableau de report ,
                    // pour pouvoir l'afficher dans la vue et signalé que cette utilisateur à signalé ce commentaire .
                    ${"messSign" . $value['id']} = 'Vous avez  signalé ce commentaire';
                }
            }
        }
        require ROOT . '/views/viewPost.php';
    }

    public function showPostAfterReport($commentId, $postId)
    {
        if (isset($_SESSION['user'])) {
            $tempReportUserArray = $this->commentManager->getReportUsers($commentId);
            if (!in_array($_SESSION['user'], $tempReportUserArray)) {
                //on ajoute l'utilisateur qui a signalé le commentaires au tableau report_user du commentaire
                $tempReportUserArray[] = $_SESSION['user'];
                $reportUserArray = implode(',', $tempReportUserArray);
                $this->commentManager->reportComment($commentId, $reportUserArray);
            }
            $this->showPost($postId);
        }
    }

    public function showPostAfterPostComment($postId, $author, $content)
    {
        if (isset($_SESSION['user'])) {
            $this->commentManager->postComment($postId, $author, $content);
            $this->message = 'Votre commentaire à bien était ajouté !';
            $this->showPost($postId);
        }
    }

    public function showConnect()
    {
        require ROOT . '/views/viewConnectRegister.php';
    }

    public function showAccueil()
    {
        $post = $this->postManager->getLastPost();
        require ROOT . '/views/viewAccueil.php';
    }

    public function show500($error)
    {
        $error = "Il y à eu une erreur !";
        require ROOT . '/views/view500.php';
        var_dump($error);
    }


}