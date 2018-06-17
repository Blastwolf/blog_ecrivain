<?php
$title = 'Une erreur s\'est produite';
ob_start();
?>
    <div class="view500-wrapper">
        <?php if (isset($error)) {
            echo ' <p class="view500">' . $error . '</p > ';
        } ?>
    </div>

<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';