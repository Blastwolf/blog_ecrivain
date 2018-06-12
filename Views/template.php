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
    <link rel="stylesheet" href="Public/assets/css/main.css"/>
    <noscript>
        <link rel="stylesheet" href="Public/assets/css/noscript.css"/>
    </noscript>
</head>
<body class="is-loading">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <a href="index.html" class="logo"><?= $title ?></a>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul class="links">
            <?php if (isset($_SESSION['user']) && ($_SESSION['user'] == 'admin')) {
                echo '<li><a href="index.php?action=admin&amp;nbPagePost=1&amp;nbPageComment=1">Administration</a></li>';
            } ?>
            <li class="active"><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=posts&amp;nbPage=1">Episodes</a></li>
            <li><?php if (isset($_SESSION['user'])) {
                    echo '<a href="index.php?action=deconnect">Déconnexion</a>';
                } else {
                    echo '<a href="index.php?action=connect">Connexion</a>';
                } ?></li>
        </ul>
        <ul class="icons">
            <?php if (isset($_SESSION['user'])) {
                echo '<li>Bienvenue : <strong>' . $_SESSION['user'] . '</strong></li>';
            } ?>
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
                    <li><input type="submit" value="Send Message"/></li>
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
            <li>&copy; Untitled</li>
            <li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
        </ul>
    </div>

</div>

<!-- Scripts -->
<script src="Public/assets/js/jquery.min.js"></script>
<script src="Public/assets/js/jquery.scrollex.min.js"></script>
<script src="Public/assets/js/jquery.scrolly.min.js"></script>
<script src="Public/assets/js/skel.min.js"></script>
<script src="Public/assets/js/util.js"></script>
<script src="Public/assets/js/main.js"></script>
<script src="public/plugins/tinymce/tinymce.min.js"></script>
<script src="public/js/init_tinymce.js" type="text/javascript"></script>
<script src="Public/js/active.js"></script>

</body>
</html>