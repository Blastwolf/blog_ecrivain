<?php
require dirname(__FILE__).'/controllers/test.php';
$path = $_SERVER['DOCUMENT_ROOT'].'/Projet_site_ecrivain/Views/viewAccueil.php';
$path_2 = dirname($_SERVER['DOCUMENT_ROOT']);
echo dirname(__FILE__);
if (isset($_GET['id'])){
    showPost($_GET['id']);
}else{
    testdeouf();
}
//header('Location:Views/viewAccueil.php');
