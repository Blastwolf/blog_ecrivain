<?php
$title = 'Administration';
ob_start(); ?>
<?php if (isset($this->message)) {
    echo '<p id="success">' . $this->message . '</p>';
} elseif (isset($error)) {
    echo '<h3 id="error">' . $message . '</h3>';

} ?>
    <div class="backendPosts">

        <h3 class="backend-Section-Title">Liste des épisodes :<span class="addPost"><a href="index.php?action=addPost&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>">Ajouter un épisode</a></span>
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Titre</th>
                    <th>Voir</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($data = $posts->fetch()) { ?>
                    <tr>
                        <td><?= $data['creation_date_fr'] ?></td>
                        <td><?= $data['title'] ?></td>
                        <td>
                            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>">Voir</a>
                        </td>
                        <td>
                            <a href="index.php?action=editPost&amp;id=<?= $data['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>">Modifier</a>
                        </td>
                        <td>
                            <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>" onClick="return confirm('Etes vous sur de vouloir supprimer ce post ?')">Supprimer</a>
                        </td>
                    </tr>

                    <?php
                } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- System de pagination -------------------------------------------------------------->
    <div class="pagination"><?php
        for ($i = 1; $i <= $this->nbTotalPostPage; $i++) {
            $currentActivePostPage = ($_GET['nbPagePost'] == $i) ? 'active' : '';
            echo('<a class="' . $currentActivePostPage . '" href="index.php?action=admin&amp;nbPagePost=' . $i . '&amp;nbPageComment=' . $_GET['nbPageComment'] . '">' . $i . '</a>');
        } ?>
        <!--------------------------------------------------------------------------------------->
    </div>
    <div class="backendComment">
        <h3 class="backend-Section-Title" id="comments">Liste des commentaires signalés : </h3>
        <?php
        if (isset($this->messageCom)) {
            echo '<p id="success">' . $this->messageCom . '</p>';
        }
        while ($comment = $comments->fetch()) { ?>
            <div class="comment">

                <p class="comment-author">Par <?= $comment['author'] ?> le <?= $comment['creation_date'] ?>

                    <span class="nbReport" style="color:red"> signalé : <?= $comment['reported'] ?> fois </span>
                    <span class="linkToPost"><a href="index.php?action=post&amp;id=<?= $comment['post_id'] ?>">Lien vers l'article</a></span>
                    <span class="button-group"><a href="index.php?action=editComment&amp;id=<?= $comment['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>#comments">Modifier</a>/
                        <a href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>#comments"
                           onClick="return confirm('Etes vous sur de vouloir supprimer ce commentaire ?')">Supprimer</a></span>

                </p>

                <?php if (isset($moderateComment['id']) && ($moderateComment['id'] == $comment['id'])) {
                    ?>

                    <form class="moderateComment" method="POST" action="index.php?action=editComment&amp;id=<?= $comment['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] . '#comments' ?>">
                        <textarea name="moderatedComment"><?= $comment['content'] ?></textarea>
                        <input type="submit" value="Valider" name="moderate">
                    </form>

                <?php } else { ?>
                    <p><i><?= $comment['content'] ?></i></p>
                <?php } ?>

            </div>
        <?php } ?>
        <!-- System de pagination---------------------------------------------------------------------->
        <div class="pagination"><?php
            for ($e = 1; $e <= $this->nbTotalCommentPage; $e++) {
                $currentActiveCommentPage = ($_GET['nbPageComment'] == $e) ? 'active' : '';
                echo('<a class="' . $currentActiveCommentPage . '" href="index.php?action=admin&amp;nbPagePost=' . $_GET['nbPagePost'] . '&amp;nbPageComment=' . $e . '#comments">' . $e . '</a>');
            } ?>
        </div>
        <!---------------------------------------------------------------------------------------------->
    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';

