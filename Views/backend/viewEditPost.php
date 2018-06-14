<?php
$title = 'Edition de billet';
ob_start(); ?>
    <div class="edit-post-wrapper">
        <form method="POST" action="index.php?action=updatePost&amp;id=<?= $post['id']; ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>">
            <label for="editPostTitle">Titre de l'article
                :</label><input type="text" name="editPostTitle" class="mytextarea" required
                                value="<?php if (isset($post)) {
                                    echo htmlspecialchars($post["title"]);
                                } ?>">
            <textarea name="editPostContent" id="mytextarea" required><?php if (isset($post)) {
                    echo nl2br(htmlspecialchars($post["content"]));
                } ?></textarea>
            <input type="submit" name="updatePost" id="updateButton">
        </form>

        <?php if (isset($data)) {
            while ($data = $comments->fetch()) { ?>
                <div class="comment">
                    <p class="comment-author">Par <?= $data['author'] ?> le <?= $data['creation_date_fr'] ?></p>
                    <p><?= $data['content'] ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>

<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';