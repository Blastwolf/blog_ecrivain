<?php
session_start();
define('ROOT', dirname(__FILE__));
require ROOT . '/controllers/ConnectRegisterController.php';
require ROOT . '/controllers/ViewFrontendController.php';
require ROOT . '/controllers/ViewBackendController.php';


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        ViewFrontendController::showPosts($_GET['nbPage']);
    } elseif ($_GET['action'] == 'post') {
        ViewFrontendController::showPost($_GET['id']);
//-----------------------------PARTIE CONNECTION--------------------//
    } elseif ($_GET['action'] == 'connect') {
        if (isset($_POST['register'])) {
            ConnectRegisterController::addUser($_POST['user-name-register'], $_POST['user-pass-register'], $_POST['user-pass-register-verif']);
        } elseif (isset($_POST['connect'])) {
            ConnectRegisterController::connectUser($_POST['user-name'], $_POST['user-pass']);
        }
        ViewFrontendController::showConnect();
    } elseif ($_GET['action'] == 'deconnect') {
        ConnectRegisterController::deconnectUser();
        ViewFrontendController::showAccueil();
//-------------------------------------------------------------------//
    } elseif ($_GET['action'] == 'postComment') {
        ViewFrontendController::showPostAfterPostComment($_GET['id'], $_SESSION['user'], $_POST['commentContent']);

    } elseif ($_GET['action'] == 'signaler') {
        ViewFrontendController::showPostAfterReport($_GET['id'], $_GET['postId']);
//-------------------------PARTIE BACKEND-------------------------------//
    } elseif ($_GET['action'] == 'admin') {
        ViewBackendController::showBackend($_GET['nbPagePost'], $_GET['nbPageComment']);
    } elseif ($_GET['action'] == 'addPost') {
        if (isset($_POST['addPost'])) {
            echo 'on aajoute un truc ou pas la';
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
        ViewBackendController::showEditComment($_GET['id'], $_GET['nbPagePost'], $_GET['nbPageComment']);
    } elseif ($_GET['action'] == 'moderateComment') {
        ViewBackendController::moderateComment($_GET['id'], $_POST['moderatedComment'], $_GET['nbPagePost'], $_GET['nbPageComment']);
    }
//---------------------------------------------------------------------------//
} else {
    ViewFrontendController::showAccueil();
}

