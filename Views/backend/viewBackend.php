<?php
$title = 'Liste des derniers posts';
ob_start(); ?>
    <div class="backendPosts">
        <h3 class="backend-Section-Title">Liste des Billets : </h3>
        <?php while ($data = $posts->fetch()) {
            ?>
            <div class="backendPost-wrapper">
                <article class="article">
                    <h3><?= htmlspecialchars($data['title']) ?> <em> Le : <?= $data['creation_date_fr'] ?></em></h3>
                    <p><?= nl2br(htmlspecialchars(substr($data['content'], 0, 400))) ?>...
                        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
                </article>

                <ul class="backendPost-option">
                    <li>
                        <button>
                            <a href="index.php?action=editPost&amp;id=<?= $data['id'] ?>">Modifier</a>
                        </button>
                    </li>
                    <li>
                        <button><a href="#">Supprimer</a></button>
                    </li>
                </ul>
            </div>
            <?php
        } ?>
    </div>
    <div class="backendComment">
        <h3 class="backend-Section-Title">Liste des commentaires signalés : </h3>
        <?php while ($comment = $comments->fetch()) { ?>
            <div class="backendPost-wrapper">
                <div class="comment">
                    <p class="comment-author">Par <?= $comment['author'] ?> le <?= $comment['creation_date'] ?>
                        <span class="nbReport" style="color:red"> signalé : <?= $comment['reported'] ?> fois </span>
                        <span class="button-group"><button><a href="index.php?action=editComment&amp;id=<?= $comment['id'] ?>">Modifier</a><button><a href="#">Supprimer</a></button></span>
                    </p>
                    <p><?= $comment['content'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>


<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';

