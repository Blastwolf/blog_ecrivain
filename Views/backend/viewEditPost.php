<?php
$title = 'Edition de billet';
ob_start(); ?>
    <div class="edit-post-wrapper">
        <?php if (isset($this->error)) {
            echo '<p id="error">' . $this->error . '</p>';
        } ?>
        <form method="POST" action="index.php?action=updatePost&amp;id=<?= $post['id']; ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>" enctype="multipart/form-data">
            <label for="editPostTitle">Titre de l'article
                :</label><input type="text" name="editPostTitle" class="mytextarea" required
                                value="<?php if (isset($post)) {
                                    echo htmlspecialchars($post["title"]);
                                } ?>">
            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Choisissez un image miniature
                pour l'épisode :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ImageManager::MAX_SIZE; ?>"/>
            <input name="fichier" type="file" id="fichier_a_uploader" required/>
            <textarea name="editPostContent" id="mytextarea" required><?php if (isset($post)) {
                    echo $post["content"];
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