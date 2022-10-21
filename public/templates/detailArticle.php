<?php $title = $detailArticle['title']; ?>
<?php
use src\Globals\Globals;

$this->globals = new Globals;
?>

<?php ob_start(); ?>

<!-- Détail de l'article -->
<div class="detailArticle">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1><?php echo $detailArticle['title']; ?></h1>
                <h2><?php echo $detailArticle['headerPost']; ?></h2>
                <p> <?php echo $detailArticle['article']; ?></p>
                <h4><?php echo $detailArticle['author']; ?> - le <?php echo $detailArticle['dateArticleFr'] ?></h4>
                <?php if(!isset($_SESSION['pseudo'])): ?>
                <?php elseif($_SESSION['statut'] == 'ROLE_ADMIN'): ?>
                    <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModifyArticle" aria-expanded="false" aria-controls="collapseModifyArticle">
                        Modifier Article
                    </button>
                    <div class="collapse" id="collapseModifyArticle">
                        <div class="card card-body">
                            <form action="index.php?updateArticle&amp;id=<?php echo $detailArticle['idArticle']; ?>" method="POST">
                                <div class="form-floating">
                                    <input name="updateTitleArticle" type="text" class="form-control" id="floatingTitle" placeholder="text" value="<?php echo $detailArticle['title']; ?>">
                                    <label for="floatingTitle">Modifier Titre</label>
                                </div>
                                <div class="form-floating">
                                    <input name="updateHeaderArticle" type="text" class="form-control" id="floatingHeader" placeholder="text" value="<?php echo $detailArticle['headerPost']; ?>">
                                    <label for="floatingHeader">Modifier Chapô</label>
                                </div>
                                <div class="form-floating">
                                    <textarea style="height: 300px;" name="updateTextArticle" id="floatingArticle" class="form-control" placeholder="Leave a comment here"><?php echo $detailArticle['article']; ?></textarea>
                                    <label for="floatingArticle">Modifier Article</label>
                                </div>
                                <div class="buttonUpdateArticle">
                                    <button style="width: 200px;" class="btn btn-success" type="submit">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                        <form action="index.php?deleteArticle&amp;id=<?=$this->globals->getGET('id');?>" method="POST">
                            <button class="btn btn-danger" type="submit" style="width: 150px;">Supprimer Article</button>
                        </form>  
                <?php endif; ?>
            </div>
        </div>
    </div>

<!-- Commentaire de l'article -->
<div class="commentsArticle">
    <h4>Commentaires :</h4>
        <?php while($comments = $commentsDetailArticle->fetch()): ?>
            <h5><?= htmlspecialchars($comments['author']); ?> :</h5>
            <p><?= htmlspecialchars($comments['comment']); ?></p>
            <h6> - le <?= $comments['dateCommentFr']; ?> -</h6>
<!-- Formulaire modification de commentaire -->
            <div class="form_comment">
                <div class="formModifyComment">
                    <?php if(isset($_SESSION['pseudo'])): ?>
                        <?php if($_SESSION['idUser'] == $comments['idUser']): ?>
                            <div class="accordion" id="accordionModifyComment">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headerModifyCom">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModifyCom<?= $comments['idComment'];?>" aria-expanded="false" aria-controls="collapseModifyButton">
                                            Modifier Commentaire
                                        </button>
                                    </h2>
                                    <div id="collapseModifyCom<?= $comments['idComment'];?>" class="accordion-collapse collapse" aria-labelledby="headerModifyCom" data-bs-parent="#accordionModifyComment">
                                        <div class="accordion-body">
                                            <form action="index.php?updateCom&amp;idCom=<?= $comments['idComment']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingModifyCom" name="textUpdateCom" style="height: 150px;"></textarea>
                                                    <label for="floatingModifyCom"></label>
                                                </div>
                                                <div class="btn">
                                                    <button class="btn btn-warning" type="reset" style="width: 100px;">Reset</button>
                                                    <button class="btn btn-success" type="submit" style="width: 100px;">Envoyer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php if(isset($_SESSION['pseudo'])): ?>
                    <?php if($_SESSION['statut'] == 'ROLE_ADMIN'): ?>
                        <div class="formDeleteCom">
                            <form action="index.php?deleteComment&amp;idCom=<?= $comments['idComment']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST">
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
</div>
<!-- Formulaire ajouter commentaire -->
<?php if(isset($_SESSION['pseudo'])): ?>
    <div class="formAddCom">
        <div class="w-75 accordion" id="accordionAddComment">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading">
                    <button  class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Ajouter Commentaire
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionAddComment">
                    <div class="accordion-body">
                        <form action="index.php?addNewComment&amp;id=<?= $detailArticle['idArticle'];?>" method="POST">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingAdd" name="comment" style="height: 150px;"></textarea>
                                <label for="floatingAdd"></label>
                            </div>
                            <div class="btn">
                                <button class="btn btn-warning" type="reset">Reset</button>
                                <button class="btn btn-success" type="submit">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p>Pour poster un commentaire vous devez être connecter</p>
    </div>
<?php endif; ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('public/templates/base.php'); ?>