<?php $title = 'Article du blog'; ?>

<?php ob_start(); ?>

<?php if(isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
            </div>
<?php else: ?>
    
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
                <?php elseif($_SESSION['statut'] == 1):
                        if(isset($errorMessage)): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo $errorMessage; ?></strong>
                        </div>
                    <?php else: ?>
                        <div class="w-75 accordion updateArticle" id="accordionExample">
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
                                                <textarea class="form-control adminUpdateArticle" placeholder="leave a comment here" id="floatingHeader" name="newTitle" style="height: 70px"></textarea><br />
                                                <label for="floatingHeader">Modifier Titre</label>
                                            </div>
                                            <div class="form-floating">
                                                <textarea class="form-control adminUpdateArticle" placeholder="leave a comment here" id="floatingHeader" name="newHeader" style="height: 70px"></textarea><br />
                                                <label for="floatingHeader">Modifier chapô</label>
                                            </div>
                                            <div class="form-floating">
                                                <textarea class="form-control adminUpdateArticle" placeholder="leave a comment here" id="floatingArticle" name="newArticle" style="height: 150px"></textarea>
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
                                    <button class="btn btn-danger" type="submit">Supprimer Article</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
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
                            <div class="accordion btnModifyCom" id="accordionModifyAdmin">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingBtnModify">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUpdateCom<?= $comment['id_comment']; ?>" aria-expanded="false" aria-controls="collapseOne">
                                            Modifier Commentaire
                                        </button>
                                    </h2>
                                    <div id="collapseUpdateCom<?= $comment['id_comment']; ?>" class="accordion-collapse collapse" aria-labelledby="headingBtnModify" data-bs-parent="#accordionModifyAdmin">
                                        <div class="accordion-body">
                                            <form action="index.php?action=updateCom&amp;idCom=<?= $comment['id_comment']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST" onsubmit="alert('Votre commentaire à bien été modifier, il est en attente de validation par la modération, merci de votre compréhension.')">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingUpdate" name="textUpdate" style="height: 150px"></textarea><br />
                                                    <label for="floatingUpdate">Modifier commentaire ici</label>
                                                </div>
                                                <button class="btn btn-outline-warning" type="reset">Reset</button>
                                                <button class="btn btn-outline-success" type="submit">Envoyer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                    <?php break; 
                        case $_SESSION['id'] == $comment['id_user']; ?>
                            <div class="accordion btnModifyCom" id="accordionModifyClient">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingBtnModify">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUpdateCom<?= $comment['id_comment']; ?>" aria-expanded="false" aria-controls="collapseOne">
                                            Modifier Commentaire
                                        </button>
                                    </h2>
                                    <div id="collapseUpdateCom<?= $comment['id_comment']; ?>" class="accordion-collapse collapse" aria-labelledby="headingBtnModify" data-bs-parent="#accordionModifyClient">
                                        <div class="accordion-body">
                                            <form action="index.php?action=updateCom&amp;idCom=<?= $comment['id_comment']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST" onsubmit="alert('Votre commentaire à bien été modifier, il est en attente de validation par la modération, merci de votre compréhension.')">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingUpdate" name="textUpdate" style="height: 150px"></textarea><br />
                                                    <label for="floatingUpdate">Modifier commentaire ici</label>
                                                </div>
                                                <button class="btn btn-outline-warning" type="reset">Reset</button>
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
    <!-- Formulaire pour poster un commentaire si connexion -->
    <div class="accordion btnAddComment" id="accordionAdd">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingBtnModify">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdd" aria-expanded="false" aria-controls="collapseOne">
                     Ajouter Commentaire
                </button>
            </h2>
            <div id="collapseAdd" class="accordion-collapse collapse" aria-labelledby="headingBtnModify" data-bs-parent="#accordionAdd">
                <div class="accordion-body">
                    <form action="index.php?action=addComment&amp;id=<?= $_GET['id']?>" method="POST" onsubmit="alert('Votre commentaire est bien envoyé et est en attente de validation')">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingUpdate" name="comment" style="height: 150px"></textarea><br />
                            <label for="floatingUpdate">Ajouter commentaire ici</label>
                        </div>
                        <div class="btnAdd">
                            <button class="btn btn-outline-warning" type="reset">Reset</button>
                            <button class="btn btn-outline-success" type="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
<?php endif; ?>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>