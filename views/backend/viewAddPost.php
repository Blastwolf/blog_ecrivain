<?php
$title = 'Ajout de billet';
ob_start(); ?>
    <div class="tinymce-post-wrapper">
        <?php if (isset($this->error)) {
            echo '<p id="error">' . $this->error . '</p>';
        } ?>
        <form class="alt" method="POST" action="index.php?action=addPost&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>" enctype="multipart/form-data">
            <label for="addPostTitle">Titre de l'article
                                      :</label>
            <input type="text" name="addPostTitle" class="mytextarea" required value="<?php
            if (isset($_POST['addPostTitle'])) echo $_POST["addPostTitle"];
            ?>"><br/>
            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Choisissez un image miniature
                                                                                       pour l'épisode :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ImageManager::MAX_SIZE; ?>"/>
            <input name="fichier" type="file" id="fichier_a_uploader" required/>
            <label for="mytextarea">Contenu de l'épisode : </label>
            <textarea id="mytextarea" name="addPostContent"><?php
                if (isset($_POST['addPostContent'])) echo $_POST["addPostContent"];
                ?></textarea>
            <input type="submit" name="addPost" id="addButton" value="Valider">
        </form>
    </div>

<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';