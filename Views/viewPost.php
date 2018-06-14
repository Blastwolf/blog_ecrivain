<?php
$title = 'Liste des derniers posts';
ob_start();
?>
    <article class="post featured">
        <header class="major">
            <span class="date"><?= $post['creation_date_fr'] ?></span>
            <h2><a href="#"><?= $post['title'] ?></a></h2>
        </header>
        <div>
            <?= $post['content'] ?>
        </div>

    </article>

    <div class="comments" id="comments">
        <h3>Commentaires :</h3>
        <?php foreach ($data as $value) {
            ?>
            <div class="comment">
                <p class="comment-author">Par <?= $value['author'] ?> le <?= $value['creation_date_fr'] ?>
                    <?php if (isset($_SESSION['user'])) {
                        if (isset(${"messSign" . $value["id"]})) {
                            echo '<span class="comment-sign">' . ${"messSign" . $value["id"]} . '</span>';
                        } else {
                            echo '<span class="signComment"><a href="index.php?action=signaler&amp;id=' . $value['id'] . '&amp;postId=' . $post['id'] . '#comments"><b>Signaler</b></a></span>';
                        }
                    }
                    ?></p>
                <blockquote><?= $value['content'] ?></blockquote>
            </div>
            <?php
        }
        ?>
        <hr>
        <h3>Poster un commentaire :</h3>
        <?php if (isset($_SESSION['user'])) { ?>
            <form class="commentForm" method="POST" action="index.php?action=postComment&amp;id=<?= $post['id'] ?>#comments">
                <textarea name="commentContent" placeholder="Ecrivez votre commentaire ici"></textarea>
                <input type="submit" name="postComment" value="Poster !">
            </form>
        <?php } else {
            echo '<p>' . 'Vous devez être connecté pour poster un message.' . '</p>';
        } ?>
    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';