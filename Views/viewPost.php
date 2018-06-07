<?php
$title = 'Liste des derniers posts';
ob_start();
?>
    <article class="article">
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <div><?= $post['content'] ?></div>
        <em class="date"> Le : <?= $post['creation_date_fr'] ?></em>
    </article>

    <div class="comments">
        <p>Commentaires :
            <?php if (isset($_SESSION['user'])) {
                echo('<span class="ifLogged"><a href="#">Ajouter</a></span>');
            } ?></p>
        <?php while ($data = $comments->fetch()) { ?>
            <div class="comment">
                <p class="comment-author">Par <?= $data['author'] ?> le <?= $data['creation_date_fr'] ?></p>
                <p><?= $data['content'] ?></p>
            </div>
            <?php
        }
        ?>
    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';