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
            //addUsers($_POST['user-name-register'], $_POST['user-pass-register'], $_POST['user-pass-register-verif']);
            ConnectRegisterController::addUser($_POST['user-name-register'], $_POST['user-pass-register'], $_POST['user-pass-register-verif']);

        } elseif (isset($_POST['connect'])) {
            // connectUser($_POST['user-name'], $_POST['user-pass']);
            ConnectRegisterController::connectUser($_POST['user-name'], $_POST['user-pass']);
            // $connect = new ConnectRegisterController($_POST['user-name'], $_POST['user-pass']);
            //$connect->connectUser();
        }
        showConnect();
    } elseif ($_GET['action'] == 'deconnect') {
        //deconnectUser();
        ConnectRegisterController::deconnectUser();
        ViewFrontendController::showAccueil();
    } elseif ($_GET['action'] == 'admin') {
        ViewBackendController::showBackend();
    } elseif ($_GET['action'] == 'editPost') {
        ViewFrontendController::showEditPost($_GET['id']);
    } elseif ($_GET['action'] == 'updatePost') {
        ViewBackendController::updatePost($_POST['editPostTitle'], $_POST['editPostContent'], $_GET['id']);
    }
} else {
    ViewFrontendController::showAccueil();
}

