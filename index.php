<?php
session_start();
define('ROOT', dirname(__FILE__));
require dirname(__FILE__) . '/controllers/test.php';
require ROOT . '/controllers/ConnectRegisterController.php';
require ROOT . '/controllers/ViewFrontendController.php';
require ROOT . '/controllers/ViewBackendController.php';


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        ViewFrontendController::showPosts();
    } elseif ($_GET['action'] == 'post') {
        ViewFrontendController::showPost($_GET['id']);
    } elseif ($_GET['action'] == 'connect') {
        if (isset($_POST['register'])) {
            ConnectRegisterController::addUser($_POST['user-name-register'], $_POST['user-pass-register'], $_POST['user-pass-register-verif']);
        } elseif (isset($_POST['connect'])) {
            ConnectRegisterController::connectUser($_POST['user-name'], $_POST['user-pass']);
        }
        ViewFrontendController::showConnect();
    } elseif ($_GET['action'] == 'postComment') {
        ViewFrontendController::showPostAfterPostComment($_GET['id'], $_SESSION['user'], $_POST['commentContent']);
    } elseif ($_GET['action'] == 'signaler') {
        ViewFrontendController::showPostAfterReport($_GET['id'], $_GET['postId']);
    } elseif ($_GET['action'] == 'deconnect') {
        ConnectRegisterController::deconnectUser();
        ViewFrontendController::showAccueil();
    } elseif ($_GET['action'] == 'admin') {
        ViewBackendController::showBackend();
    } elseif ($_GET['action'] == 'editPost') {
        ViewBackendController::showEditPost($_GET['id']);
    } elseif ($_GET['action'] == 'updatePost') {
        ViewBackendController::updatePost($_POST['editPostTitle'], $_POST['editPostContent'], $_GET['id']);
    }
} else {
    ViewFrontendController::showAccueil();
}

