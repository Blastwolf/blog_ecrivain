<?php
$title = 'Liste des derniers épisodes';
ob_start();
?>
    <section class="posts">
        <?php while ($data = $posts->fetch()) {
            ?>
            <article>
                <header>
                    <span class="date"><?= $data['creation_date_fr'] ?></span>
                    <h2><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a></h2>
                </header>

                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="image fit"><img src="public/images/thumbnails/<?= $data['image_name'] ?>" alt=""></a>

                <div>
                    <?= substr($data['content'], 0, 400) ?>
                </div>

                <ul class="actions">
                    <li><a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="button">Lire la suite</a></li>
                </ul>
            </article>
            <?php
        }
        ?>
    </section>
    <!--System de pagination---------------------------------------------------------------------------->
    <div class="pagination"><?php
        for ($i = 1; $i <= $nbTotalPages; $i++) {
            $activePage = ($_GET['nbPage'] == $i) ? 'active' : '';
            echo('<a class ="' . $activePage . '" href="index.php?action=posts&amp;nbPage=' . $i . '">' . $i . '</a>');
        } ?>
    </div>
    <!----------------------------------------------------------------------------------------------------->


<?php
$content = ob_get_clean();
require ROOT . '/views/template.php';