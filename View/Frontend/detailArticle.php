<?php $title = 'Article du blog'; ?>

<?php ob_start(); ?>

<div class="testNeo">
<h3><?php $article['title']; ?></h3>
    <h5><?= htmlspecialchars($article['title']) ?></h5>
    <p>
        <strong>Chapô</strong> : <?= nl2br(htmlspecialchars($article['header_post'])); ?><br /><br />
        <strong>Contenu</strong> : <?= nl2br(htmlspecialchars($article['article'])) ?>
    </p>
    <h5>
        <strong> <?= htmlspecialchars($article['author']) ?> </strong><br />
        <em>Le <?= $article['date_article_fr'] ?></em>
    </h5>
    <?php if(!isset($_SESSION['pseudo'])): ?>
                <?php elseif($_SESSION['id'] == $article['id_user']): ?>
                    <div class="w-75 accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <strong>Modifier Article</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form action="index.php?action=updateArticle&amp;id=<?=$_GET['id'];?>" method="POST">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="leave a comment here" id="floatingHeader" name="newHeader" style="height: 70px"></textarea><br />
                                            <label for="floatingHeader">Modifier chapô</label>
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="leave a comment here" id="floatingArticle" name="newArticle" style="height: 150px"></textarea>
                                            <label for="floatingArticle">Modifier Article</label>
                                        </div>
                                        <div>
                                            <br />
                                            <button class="btn btn-outline-warning" type="reset">Reset</button>
                                            <button class="btn btn-outline-success" type="submit">Envoyer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php endif; ?>
<!--</div>-->
<br />
<h5><strong>Section des commentaires : </strong></h5>

<?php
    while($comment = $comments->fetch())
    {
    ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['date_comment_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
    }
?>
<br />
<?php
if(!isset($_SESSION['pseudo'])): ?>
    <p>
        Vous devez être connecté pour poster un commentaire.<br />
        Je vous invite donc à vous connecter ou à vous inscrire si ce n'est pas encore fait.
    </p>
<?php
else: ?>
    <div class="w-75 accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <strong>Ajouter Commentaire</strong>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <form action="index.php?action=addComment&amp;id=<?= $_GET['id']?>" method="POST" onsubmit="alert('Votre commentaire est bien envoyé et est en attente de validation')">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="leave a comment here" id="comment" name="comment" style="height: 170px"></textarea>
                                <label for="comment">Mon Commentaire</label>
                            </div>
                            <div>
                                <br />
                                <button class="btn btn-outline-warning" type="reset">Reset</button>
                                <button class="btn btn-outline-success" type="submit">Envoyer</button>
                            </div>                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>