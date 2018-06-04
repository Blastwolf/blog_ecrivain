<?php
$title = 'Bienvenue sur la page d\'accueil';
ob_start();
?>

<div>
<h1>Voici le contenu de mon site</h1>
<p>blablabla differents texte </p>
</div>
<?php
$content = ob_get_clean();
require 'template.php';
