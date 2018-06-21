<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

    <meta property="og:title" content="<?= $title ?>"/>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'posts') {
        echo '<meta property="og:url" content="http://benjaminjanel.tk/blog_ecrivain/index.php?action=posts&nbPage=1"/>';
        echo '<meta property="og:description" content="Venez découvrir la liste des épisodes du roman de Jean Forteroche <Billet simple pour l\'Alaska>">';
        echo '<meta property="og:image" content="http://benjaminjanel.tk/blog_ecrivain/public/images/global/night_bg.jpg"/>';
    } elseif (isset($_GET['action']) && $_GET['action'] == 'post') {
        echo '<meta property="og:image" content="http://benjaminjanel.tk/blog_ecrivain/public/images/thumbnails/' . $post['image_name'] . '"/>';
        echo '<meta property="og:description" content="Venez lire l\'épisode complet <' . $title . '> sur le site de Jean Forteroche">';
    } ?>
    <meta property="og:title" content="Jean Forteroche <Billet simple pour l'Alaska>"/>
    <meta property="og:type" content="article"/>

    <link rel="stylesheet" href="public/assets/css/main.css"/>
    <link rel="stylesheet" href="public/assets/css/style.css"/>
    <noscript>
        <link rel="stylesheet" href="public/assets/css/noscript.css"/>
    </noscript>
</head>
<body class="is-loading">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <a href="index.php" class="logo"><?= $title ?></a>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul class="links">
            <?php
            if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
                //on test si $get = admin si oui on met la class active
                if ($_GET['action'] == 'admin' OR $_GET['action'] == 'editPost' OR $_GET['action'] == 'addPost' OR $_GET['action'] == 'deletePost') {
                    $active = 'active';
                } else {
                    $active = '';
                }
                echo '<li class="' . $active . '"><a href="index.php?action=admin&amp;nbPagePost=1&amp;nbPageComment=1">Administration</a></li>';
            } ?>

            <li class=""><a href="index.php">Accueil</a></li>

            <li class="<?php if ($_GET['action'] == 'posts' OR $_GET['action'] == 'post' OR $_GET['action'] == 'signaler') {
                echo 'active';
            } ?>"><a href="index.php?action=posts&amp;nbPage=1">Episodes</a></li>

            <li class="<?php if ($_GET['action'] == 'connect') {
                echo 'active';
            } ?>"><?php if (isset($_SESSION['user'])) {
                    echo '<a href="index.php?action=deconnect">Déconnexion</a>';
                } else {
                    echo '<a href="index.php?action=connect">Connexion</a>';
                } ?></li>
        </ul>
        <?php if (isset($_SESSION['user'])) {
            echo '<span class="connected">Bienvenue : <strong>' . $_SESSION['user'] . '</strong></span>';
        } ?>
        <ul class="icons">
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">

        <?= $content ?>

    </div>

    <!-- Footer -->
    <footer id="footer">
        <section>
            <form method="post" action="#">
                <div class="field">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name"/>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"/>
                </div>
                <div class="field">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="3"></textarea>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Envoyer"/></li>
                </ul>
            </form>
        </section>
        <section class="split contact">
            <section class="alt">
                <h3>Addresse</h3>
                <p>49, rue de l'Aigle<br/>
                   59110 LA MADELEINE</p>
            </section>
            <section>
                <h3>Téléphone</h3>
                <p><a href="#">01-02-03-04-05</a></p>
            </section>
            <section>
                <h3>Email</h3>
                <p><a href="#">info@untitled.tld</a></p>
            </section>
            <section>
                <h3>Social</h3>
                <ul class="icons alt">
                    <li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
                </ul>
            </section>
        </section>
    </footer>
    <!-- Copyright -->
    <div id="copyright">
        <ul>
            <li>Par Benjamin JANEL</li>
            <li>Formation Openclassrooms Développeur Web Junior </a></li>
        </ul>
    </div>

</div>

<!-- Scripts -->
<script src="public/assets/js/jquery.min.js"></script>
<script src="public/assets/js/jquery.scrollex.min.js"></script>
<script src="public/assets/js/jquery.scrolly.min.js"></script>
<script src="public/assets/js/skel.min.js"></script>
<script src="public/assets/js/util.js"></script>
<script src="public/assets/js/main.js"></script>
<script src="public/plugins/tinymce/tinymce.min.js"></script>
<script src="public/js/init_tinymce.js" type="text/javascript"></script>
<script src="public/js/message.js"></script>

</body>
</html>