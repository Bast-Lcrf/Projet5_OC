<?php $title = 'Article du blog'; ?>

<?php ob_start(); ?>

<div class="detail">
<h3><?php $article['title']; ?></h3>
    <h3> - <?= htmlspecialchars($article['title']) ?> - </h3>
    <h4><strong>Chapô</strong> :</h4>
    <p><?= nl2br(htmlspecialchars($article['header_post'])); ?></p>
    <h5><strong>Article</strong> :</h5>
    <p><?= nl2br(htmlspecialchars($article['article'])) ?></p>
    <h6>
        <strong> <?= htmlspecialchars($article['author']) ?> </strong><br />
        <em>Le <?= $article['date_article_fr'] ?></em>
    </h6>
    <?php if(!isset($_SESSION['pseudo'])): ?>
                <?php elseif($_SESSION['id'] == $article['id_user']): ?>
                    <div class="w-75 accordion updateArticle" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button style="width:500px" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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
                    <div class="deleteArticle">
                        <form action="index.php?action=deleteArticle&amp;id=<?=$_GET['id'];?>" method="POST">
                            <button class="btn btn-danger" type="submit" style="width: 200px">Supprimer Article</button>
                        </form>
                    </div>
                </div>
    <?php endif; ?>
</div>
<div class="detailComSection">
<br />
<h4><strong>Section des commentaires : </strong></h4>

<?php
    while($comment = $comments->fetch()) // Affiche les comentaires
    {
    ?>
        <h5><strong><?= htmlspecialchars($comment['author']) ?></strong></h5>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <h6>le <?= $comment['date_comment_fr'] ?></h6>
         <!-- formulaire de modification de commentaire avec restrictions par utilisateur et modérateur -->
        <div class="divider">
            <?php if(isset($_SESSION['pseudo'])): ?>
                <div class="">
                    <?php switch($_SESSION) {
                        case $_SESSION['statut'] == 1; ?>
                        <?php if(isset($errorMessage)): ?>
                            <div class="w-50 alert alert-danger" role="alert">
                                <strong><?php echo $errorMessage; ?></strong>
                            </div>
                        <?php endif; ?>
                            <div class="accordion btnModifyCom" id="accordionUpdateCom">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUpdateCom<?= $comment['id_comment']; ?>" aria-expanded="false" aria-controls="collapseUpdate">
                                            <strong>Modifier Commentaire</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseUpdateCom<?= $comment['id_comment']; ?>" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionUpdateCom">
                                        <div class="accordion-body">
                                            <form action="index.php?action=updateCom&amp;idCom=<?= $comment['id_comment']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST" onsubmit="alert('Votre commentaire à bien été modifier, il est en attente de validation par la modération, merci de votre compréhension.')">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="leave a comment here" id="floatingUpdate" name="textUpdate" style="height: 100px"></textarea><br />
                                                    <label for="floatingUpdate">Modifier Commentaire</label>
                                                </div>
                                                <button class="btn btn-outline-success" type="submit">Envoyer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                    <?php break; 
                        case $_SESSION['id'] == $comment['id_user']; ?>
                        <?php if(isset($errorMessage)): ?>
                            <div class="w-50 alert alert-danger" role="alert">
                                <strong><?php echo $errorMessage; ?></strong>
                            </div>
                        <?php endif; ?>
                            <div class="accordion btnModifyCom" id="accordionUpdateCom">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUpdate" aria-expanded="false" aria-controls="collapseUpdate" style="width: 500px">
                                                <strong>Modifier mon Commentaire</strong>
                                            </button>
                                        </h2>
                                        <div id="collapseUpdate" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionUpdateCom">
                                            <div class="accordion-body">
                                                <form action="index.php?action=updateCom&amp;idCom=<?= $comment['id_comment']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST" onsubmit="alert('Votre commentaire à bien été modifier, il est en attente de validation par la modération, merci de votre compréhension.')">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="leave a comment here" id="floatingUpdate" name="textUpdate" style="height: 100px"></textarea><br />
                                                        <label for="floatingUpdate">Modifier Commentaire</label>
                                                    </div>
                                                    <button class="btn btn-outline-success" type="submit">Envoyer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php break;
                            default; 
                            break;  
                    } ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }
?>
</div>
<br />
<?php
if(!isset($_SESSION['pseudo'])): ?>
    <div class="alert alert-warning msgWarning" role="alert">
        <p><strong>Vous devez être connecté pour poster un commentaire.<br />
        Je vous invite donc à vous connecter ou à vous inscrire si ce n'est pas encore fait.</strong></p>
    </div>
<?php
else: ?>
    <div class="w-50 accordion accordion-flush buttonComment" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" style="width: 100%" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
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
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>