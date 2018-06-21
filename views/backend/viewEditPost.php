<?php
$title = 'Edition d\'épisode';
ob_start(); ?>
    <div class="edit-post-wrapper">
        <?php if (isset($this->error)) {
            echo '<p id="error">' . $this->error . '</p>';
        } ?>
        <form class="alt" method="POST" action="index.php?action=editPost&amp;id=<?= $post['id']; ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>" enctype="multipart/form-data">

            <label for="editPostTitle">Titre de l'article :</label><input type="text" name="editPostTitle" class="mytextarea" required value="<?php if (isset($post)) {
                echo htmlspecialchars($post["title"]);
            } ?>"><br/>

            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Changer l'image miniature pour l'épisode ?(jpg,gif,png,jpeg) :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ImageManager::MAX_SIZE; ?>"/>
            <input name="fichier" type="file" id="fichier_a_uploader"/>

            <textarea name="editPostContent" id="tinyMCE" required><?php if (isset($post)) {
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