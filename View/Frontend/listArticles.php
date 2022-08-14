<?php $title = 'Liste des Articles'; ?>

<?php ob_start(); ?>

<h3>Les derniers Articles postés</h3>

<?php

while($data = $list->fetch())
{
?>
    <div class="list_billet">
        <h5>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['date_article_fr'] ?></em>
        </h5>

        <p>
            <?= nl2br(htmlspecialchars($data['header_post'])) ?>
            <br />
            <em><a href="index.php?action=detailArticle&amp;id=<?= $data['id_article'] ?>">En voir plus</a></em>
        </p>
    </div>
<?php
}
$list->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>

