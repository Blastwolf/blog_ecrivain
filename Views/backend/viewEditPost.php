<?php
$title = 'Edition de billet';
ob_start(); ?>
    <div class="edit-post-wrapper">
        <form method="POST" action="#">
            <textarea name="editPost" id="mytinymce" value="<?php if (isset($post)) {
                echo $post;
            } ?>"></textarea>
        </form>
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