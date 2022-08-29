<?php $title = 'Liste des Articles'; ?>

<?php ob_start(); ?>
<div class=listBilletTitle>
    <h3>Les derniers Articles</h3>
</div>

<?php

while($data = $list->fetch())
{
?>
    <div class="list_billet">
        <h5>Titre :
            <?= htmlspecialchars($data['title']) ?> - <em>le <?= $data['date_article_fr'] ?></em>
        </h5>

        <p>Chapô : <?= nl2br(htmlspecialchars($data['header_post'])) ?></p>
        <p><em><a href="index.php?action=detailArticle&amp;id=<?= $data['id_article'] ?>"><strong>- Lire l'article -</strong></a></em></p>
    </div>
<?php
}
$list->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>

