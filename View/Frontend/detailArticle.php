<?php $title = 'Article du blog'; ?>

<?php ob_start(); ?>
<h3><?php $article['title']; ?></h3>

<div>
    <h5>
        <?= htmlspecialchars($article['title']) ?>
    </h5>

    <p>
        <strong>Chapô</strong> : <?= nl2br(htmlspecialchars($article['header_post'])); ?><br /><br />
        <strong>Contenu</strong> : <?= nl2br(htmlspecialchars($article['article'])) ?>
    </p>

    <h5>
        <strong> <?= htmlspecialchars($article['author']) ?> </strong><br />
        <em>Le <?= $article['date_article_fr'] ?></em>
    </h5>
</div>
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
    <h5>Poster un commentaire :</h5>
    <?php if(empty($_POST)): ?>
        <form action="index.php?action=addComment&amp;id=<?= $_GET['id']?>" method="POST">
                <div>
                    <label for="comment">Mon Commentaire</lable><br />
                    <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                </div>
                <div>
                    <br />
                    <input type="submit" value="Envoyer">
                </div>                    
        </form>
    <?php else: ?>
        <br />
        <div class="alert alert-success" role="alert">
            Votre commentaire est en attente de validation
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>