<?php
$title = 'Bienvenue sur la page d\'accueil';
ob_start();
?>

    <div>
        <h1>Voici le contenu de mon site</h1>
        <p>blablabla differents texte </p>
        <?php if (isset($_SESSION['user'])) {
            echo 'salut ' . $_SESSION['user'];
        } ?>
    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';
