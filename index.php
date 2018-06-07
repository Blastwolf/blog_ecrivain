<?php
session_start();
define('ROOT', dirname(__FILE__));
require dirname(__FILE__) . '/controllers/test.php';


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        showPosts();
    } elseif ($_GET['action'] == 'post') {
        showPost($_GET['id']);
    } elseif ($_GET['action'] == 'connect') {
        if (isset($_POST['register'])) {
            addUsers($_POST['user-name-register'], $_POST['user-pass-register'], $_POST['user-pass-register-verif']);
        } elseif (isset($_POST['connect'])) {
            connectUser($_POST['user-name'], $_POST['user-pass']);
        }
        showConnect();
    } elseif ($_GET['action'] == 'deconnect') {
        deconnectUser();
        showAccueil();
    } elseif ($_GET['action'] == 'admin') {
        showBackend();
    } elseif ($_GET['action'] == 'editPost') {
    }
} else {
    showAccueil();
}

