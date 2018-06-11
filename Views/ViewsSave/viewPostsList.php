<?php
$title = 'Liste des derniers posts';
ob_start();

while ($data = $posts->fetch()) {
    ?>

    <article class="article">
        <h3><?= htmlspecialchars($data['title']) ?> <em> Le : <?= $data['creation_date_fr'] ?></em></h3>
        <div><?= (substr($data['content'], 0, 400)) ?>...
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></div>
    </article>
    <?php
}
for ($i = 1; $i <= $nbTotalPages; $i++) {
    echo('<a href="index.php?action=posts&amp;nbPage=' . $i . '">' . $i . '</a>');
}
$content = ob_get_clean();
require ROOT . '/views/template.php';