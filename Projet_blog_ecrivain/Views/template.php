<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav class="navbar">
    <ul class="navbar-menu">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="index.php?action=posts">Articles</a></li>
        <li><a href="index.php?action=connect">Connexion</a></li>
    </ul>
    <?php echo dirname(__FILE__);?>
</nav>
<?= $content ?>
</body>
</html>