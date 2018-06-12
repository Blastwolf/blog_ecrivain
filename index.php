<?php
session_start();
define('ROOT', dirname(__FILE__));
require ROOT . '/controllers/ConnectRegisterController.php';
require ROOT . '/controllers/ViewFrontendController.php';
require ROOT . '/controllers/ViewBackendController.php';
$connectRegisterController = new ConnectRegisterController();
$viewFrontendController = new ViewFrontendController();


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        $viewFrontendController->showPosts($_GET['nbPage']);
    } elseif ($_GET['action'] == 'post') {
        $viewFrontendController->showPost($_GET['id']);
//-----------------------------PARTIE CONNECTION--------------------//
    } elseif ($_GET['action'] == 'connect') {
        if (isset($_POST['register'])) {
            $connectRegisterController->addUser($_POST['user-name-register'], $_POST['user-pass-register'], $_POST['user-pass-register-verif']);
        } elseif (isset($_POST['connect'])) {
            $connectRegisterController->connectUser($_POST['user-name'], $_POST['user-pass']);
        }
        $viewFrontendController->showConnect();
    } elseif ($_GET['action'] == 'deconnect') {
        $connectRegisterController->deconnectUser();
        $viewFrontendController->showAccueil();
//-------------------------------------------------------------------//
    } elseif ($_GET['action'] == 'postComment') {
        $viewFrontendController->showPostAfterPostComment($_GET['id'], $_SESSION['user'], $_POST['commentContent']);

    } elseif ($_GET['action'] == 'signaler') {
        $viewFrontendController->showPostAfterReport($_GET['id'], $_GET['postId']);
//-------------------------PARTIE BACKEND-------------------------------//
        //on verifie que l'administrateur du serveur soit bien connecté
    } elseif (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
        $viewBackendController = new ViewBackendController();
        if ($_GET['action'] == 'admin') {
            $viewBackendController->showBackend($_GET['nbPagePost'], $_GET['nbPageComment']);
        } elseif ($_GET['action'] == 'addPost') {
            if (isset($_POST['addPost'])) {
                ViewBackendController::addPost($_POST['addPostTitle'], $_POST['addPostContent']);
            } else {
                ViewBackendController::showAddPost();
            }

        } elseif ($_GET['action'] == 'editPost') {
            ViewBackendController::showEditPost($_GET['id']);
        } elseif ($_GET['action'] == 'updatePost') {
            ViewBackendController::updatePost($_POST['editPostTitle'], $_POST['editPostContent'], $_GET['id']);
        } elseif ($_GET['action'] == 'deletePost') {
            ViewBackendController::deletePost($_GET['id']);
        } elseif ($_GET['action'] == 'editComment') {
            $viewBackendController->showEditComment($_GET['id'], $_GET['nbPagePost'], $_GET['nbPageComment']);
        } elseif ($_GET['action'] == 'moderateComment') {
            $viewBackendController->moderateComment($_GET['id'], $_POST['moderatedComment'], $_GET['nbPagePost'], $_GET['nbPageComment']);
        }
    } else {
        echo 'Vous souhaitez acceder à une zone résèrvé à l\'administrateur';
    }
//---------------------------------------------------------------------------//
} else {
    $viewFrontendController->showAccueil();
}

