<?php
$title = 'Ajout de billet';
ob_start(); ?>
    <div class="tinymce-post-wrapper">
        <form method="POST" action="index.php?action=addPost">
            <label for="addPostTitle">Titre de l'article
                :</label><input type="text" name="addPostTitle" class="mytextarea" required><br/>
            <textarea id="mytextarea" name="addPostContent" id="mytextarea"></textarea>
            <input type="submit" name="addPost" id="addButton" value="Valider">
        </form>
    </div>

<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';