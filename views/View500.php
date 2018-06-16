<?php
$title = 'Liste des derniers épisodes';
ob_start();
?>

<?php if (isset($error)) {
    echo $error;
} ?>


<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';