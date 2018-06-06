<?php
session_start();

require dirname(__FILE__) . '/controllers/test.php';
$path = $_SERVER['DOCUMENT_ROOT'] . '/Projet_site_ecrivain/Views/viewAccueil.php';
$path_2 = dirname($_SERVER['DOCUMENT_ROOT']);
echo dirname(__FILE__);


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        showPosts();
    } elseif ($_GET['action'] == 'post') {
        showPost($_GET['id']);
    } elseif ($_GET['action'] == 'connect') {
        if (isset($_POST['register'])) {
            addUsers($_POST['user-name-register'], $_POST['user-pass-register']);
        } elseif (isset($_POST['connect'])) {
            connectUser($_POST['user-name'], $_POST['user-pass']);
        }
        showConnect();
    }
} else {
    showAccueil();
}


//    showPost($_GET['id']);
//} elseif (isset($_GET['action']) && ($_GET['action'] == 'connect')) {
//    require 'views/viewConnectRegister.php';
//} else {
//    if (isset($_POST['register'])) {
//        if (isValid($_POST['user-name-register'], $_POST['user-pass-register'])) {
//            addUsers($_POST['user-name-register'], $_POST['user-pass-register']);
//            echo 'added';
//        }else{
//            require 'views/viewConnectRegister.php';
//        }
//    }
//    showPosts();
//
//}
//header('Location:Views/viewAccueil.php');
