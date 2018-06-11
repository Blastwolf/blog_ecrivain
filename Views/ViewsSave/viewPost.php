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
        <h2>Commentaires :</h2>
        <?php foreach ($data as $key => $value) {
            ?>
            <div class="comment">
                <p class="comment-author">Par <?= $data[$key]['author'] ?> le <?= $data[$key]['creation_date_fr'] ?>
                    <?php if (isset($_SESSION['user'])) {
                        if (isset(${"messSign" . $data[$key]["id"]})) {
                            echo '<span class="comment-sign">' . ${"messSign" . $data[$key]["id"]} . '</span>';
                        } else {
                            echo '<span><a href="index.php?action=signaler&amp;id=' . $data[$key]['id'] . '&amp;postId=' . $post['id'] . '">Signaler</a></span>';
                        }
                    }
                    ?></p>
                <p><?= $data[$key]['content'] ?></p>
            </div>
            <?php
        }
        ?>
        <h2>Poster un commentaire :</h2>
        <div class="comment commentForm">
            <form method="POST" action="index.php?action=postComment&amp;id=<?= $post['id'] ?>">
                <textarea name="commentContent" placeholder="Ecrivez votre commentaire ici"></textarea><br/>
                <input type="submit" name="postComment" value="Poster !">
            </form>
        </div>
    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';