<?php
$title = 'Liste des derniers posts';
ob_start(); ?>
    <div class="backendPosts">
        <h3 class="backend-Section-Title">Liste des Billets :
            <span><a href="index.php?action=addPost">Ajouter un Billet</a></span></h3>
        <?php while ($data = $posts->fetch()) {
            ?>
            <div class="backendPost-wrapper">
                <article class="article">
                    <h3><?= $data['title'] ?> <em> Le : <?= $data['creation_date_fr'] ?></em></h3>
                    <p><?= nl2br(substr($data['content'], 0, 400)) ?>...
                        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
                </article>

                <ul class="backendPost-option">
                    <li>
                        <button>
                            <a href="index.php?action=editPost&amp;id=<?= $data['id'] ?>">Modifier</a>
                        </button>
                    </li>
                    <li>
                        <button><a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>">Supprimer</a></button>
                    </li>
                </ul>
            </div>
            <?php
        } ?>
    </div>
<?php
$currentCommentPage = $_GET['nbPageComment'];
for ($i = 1; $i <= $nbTotalPostPage; $i++) {
    echo('<a href="index.php?action=admin&amp;nbPagePost=' . $i . '&amp;nbPageComment=' . $currentCommentPage . '">' . $i . '</a>');
} ?>
    <div class="backendComment">
        <h3 class="backend-Section-Title">Liste des commentaires signalés : </h3>
        <?php while ($comment = $comments->fetch()) { ?>
            <div class="backendPost-wrapper">
                <div class="comment">
                    <p class="comment-author">Par <?= $comment['author'] ?> le <?= $comment['creation_date'] ?>
                        <span class="nbReport" style="color:red"> signalé : <?= $comment['reported'] ?> fois </span>
                        <span class="linkToPost"><a href="index.php?action=post&amp;id=<?= $comment['post_id'] ?>">Lien vers l'article</a></span>
                        <span class="button-group"><button><a href="index.php?action=editComment&amp;id=<?= $comment['id'] ?>">Modifier</a><button><a href="#">Supprimer</a></button></span>
                    </p>
                    <?php if (isset($moderateComment['id']) && ($moderateComment['id'] == $comment['id'])) { ?>
                        <form method="POST" action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>">
                            <textarea name="moderatedComment"><?= $comment['content'] ?></textarea>
                            <input type="submit" value="Valider">
                        </form>
                    <?php } else { ?>
                        <p><?= $comment['content'] ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
$currentPostPage = $_GET['nbPageComment'];
for ($e = 1; $e <= $nbTotalCommentPage; $e++) {
    echo('<a href="index.php?action=admin&amp;nbPagePost=' . $currentPostPage . '&amp;nbPageComment=' . $e . '">' . $e . '</a>');

} ?>


<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';

