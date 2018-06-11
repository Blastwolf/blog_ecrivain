<?php
$title = 'Administration : Liste des derniers posts';
ob_start(); ?>
    <div class="backendPosts">
        <h3 class="backend-Section-Title">Liste des épisodes :
            <span class="addPost"><a href="index.php?action=addPost">Ajouter un épisode</a></span></h3>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Titre</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($data = $posts->fetch()) { ?>
                    <tr>
                        <td><?= $data['creation_date_fr'] ?></td>
                        <td><?= $data['title'] ?></td>
                        <td><a href="index.php?action=editPost&amp;id=<?= $data['id'] ?>">Modifier</a></td>
                        <td>
                            <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>" onClick="return confirm('Etes vous sur de vouloir supprimer ce post ?')">Supprimer</a>
                        </td>
                    </tr>

                    <?php
                } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination"><?php
        $currentCommentPage = (isset($_GET['nbPageComment'])) ? $_GET['nbPageComment'] : 1;
        for ($i = 1; $i <= $nbTotalPostPage; $i++) {
            echo('<a href="index.php?action=admin&amp;nbPagePost=' . $i . '&amp;nbPageComment=' . $currentCommentPage . '">' . $i . '</a>');
        } ?>
    </div>
    <div class="backendComment">
        <h3 class="backend-Section-Title">Liste des commentaires signalés : </h3>
        <?php while ($comment = $comments->fetch()) { ?>
            <div class="comment">
                <p class="comment-author">Par <?= $comment['author'] ?> le <?= $comment['creation_date'] ?>
                    <span class="nbReport" style="color:red"> signalé : <?= $comment['reported'] ?> fois </span>
                    <span class="linkToPost"><a href="index.php?action=post&amp;id=<?= $comment['post_id'] ?>">Lien vers l'article</a></span>
                    <span class="button-group"><a href="index.php?action=editComment&amp;id=<?= $comment['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>">Modifier</a>/<a href="#">Supprimer</a></span>
                </p>

                <?php if (isset($moderateComment['id']) && ($moderateComment['id'] == $comment['id'])) {
                    $moderateComment['id'] ?>
                    <form class="moderateComment" method="POST" action="index.php?action=moderateComment&amp;id=<?= $comment['id'] ?>&amp;nbPagePost=<?= $_GET['nbPagePost'] ?>&amp;nbPageComment=<?= $_GET['nbPageComment'] ?>">
                        <textarea name="moderatedComment"><?= $comment['content'] ?></textarea>
                        <input type="submit" value="Valider">
                    </form>
                <?php } else { ?>
                    <blockquote><?= $comment['content'] ?></blockquote>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="pagination"><?php
            $currentPostPage = (isset($_GET['nbPagePost'])) ? $_GET['nbPagePost'] : 1;
            for ($e = 1; $e <= $nbTotalPostPage; $e++) {
                echo('<a href="index.php?action=admin&amp;nbPagePost=' . $currentPostPage . '&amp;nbPageComment=' . $e . '">' . $e . '</a>');
            } ?>
        </div>
    </div>
<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';

