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

    <div class="comments">
        <h3>Commentaires :</h3>
        <?php foreach ($data as $key => $value) {
            ?>
            <div class="comment">
                <p class="comment-author">Par <?= $data[$key]['author'] ?> le <?= $data[$key]['creation_date_fr'] ?>
                    <?php if (isset($_SESSION['user'])) {
                        if (isset(${"messSign" . $data[$key]["id"]})) {
                            echo '<span class="comment-sign">' . ${"messSign" . $data[$key]["id"]} . '</span>';
                        } else {
                            echo '<span class="signComment"><a href="index.php?action=signaler&amp;id=' . $data[$key]['id'] . '&amp;postId=' . $post['id'] . '"><b>Signaler</b></a></span>';
                        }
                    }
                    ?></p>
                <blockquote><?= $data[$key]['content'] ?></blockquote>
            </div>
            <?php
        }
        ?>
        <hr>
        <h3>Poster un commentaire :</h3>

        <form class="commentForm" method="POST" action="index.php?action=postComment&amp;id=<?= $post['id'] ?>">
            <textarea name="commentContent" placeholder="Ecrivez votre commentaire ici"></textarea>
            <input type="submit" name="postComment" value="Poster !">
        </form>

    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';