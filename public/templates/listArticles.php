<?php $title = "Les Articles"; ?>
<?php
use src\Manager\ArticlesManager;

$this->articleManager = new ArticlesManager;
$listArticles = $this->articleManager->readAllArticle();
?>
<?php ob_start() ?>
<div class="listBackground">
    <h1>Liste des articles</h1>
</div>
    <div class="list_articles">
        <?php while($data = $listArticles->fetch()) { ?>
            <div class="card_article">
                <h5>Titre : <?= htmlspecialchars($data['title']) ?></h5>
                <p>Chapô : <?= nl2br(htmlspecialchars($data['headerPost'])) ?></p>
                <p><em>le <?= $data['dateArticleFr'] ?></em></p>
                <div class="card_link">
                    <span><a href="index.php?detailArticle&id=<?= $data['idArticle']; ?>"><strong>- Lire l'article -</strong></a></span>
                </div>
            </div>
        <?php
        }
        $listArticles->closeCursor(); ?>
    </div>

<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>