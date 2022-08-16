<?php $title = 'Liste des Articles'; ?>

<?php ob_start(); ?>

<h3><strong>Les derniers Articles</strong></h3>

<?php

while($data = $list->fetch())
{
?>
    <div class="list_billet">
        <h5>Titre :
            <?= htmlspecialchars($data['title']) ?> -
            <em>le <?= $data['date_article_fr'] ?></em>
        </h5>

        <p>Chapô : <?= nl2br(htmlspecialchars($data['header_post'])) ?></p>
        <p><em><a href="index.php?action=detailArticle&amp;id=<?= $data['id_article'] ?>"><strong>- Lire L'article -</strong></a></em></p>
    </div>
<?php
}
$list->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>

