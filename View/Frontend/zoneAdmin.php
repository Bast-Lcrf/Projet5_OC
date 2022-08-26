<?php $title = "Zone Administration"; ?>

<?php ob_start(); ?>

<p>
<?php if(!isset($_SESSION['pseudo'])): ?>
    <div class="alert alert-warning msgWarning" role="alert">
    <p>Page non autorisée pour le commun des mortels, vous devez avoir l'autorisation du maitre des lieux !</p>
    </div>
<?php elseif($_SESSION['statut'] == 1): ?>
    <div class="container" id="admin">
        <div class="row">
            <div class="col-lg-5 formNewPost">
                <h4>Nouvel Article :</h4>
                <form action="index.php?action=newArticle" method="POST">
                    <div class="lg-3 form-floating">
                        <input type="text" class="form-control" id="floatingTitle" placeholder="text" name="title"/>
                        <label for="floatingTitle">Titre :</label>
                    </div>
                    <div class="lg-3 form-floating">
                        <input type="text" class="form-control" id="header_post" placeholder="text" name="header_post"/>
                        <label for="floatingHeader_post">Chapô :</label>
                    </div>
                    <div class="lg-3 form-floating">
                        <textarea class="form-control" id="floatingArticle" placeholder="Leave a comment here" name="article" style="height: 500px"></textarea>
                        <label for="floatingArticle">Article :</label>
                    </div>
                    <div class="lg-3">
                        <button class="btn btn-success" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 commentModeration">
                <h4>Modération des commentaires :</h4>
                <?php
                        foreach($validView as $data) {
                        ?>
                        <div class="dividerCommentModeration">
                            <div>
                                <h5> <?= htmlspecialchars($data['author']); ?></h5>
                                <p>Commentaire nº<?=$data['id_comment'];?></p>
                                <p>Commentaire pour <a target="blank" href="index.php?action=detailArticle&amp;id=<?= $data['id_article']; ?>">article nº<?=$data['id_article'];?></a></p>
                                <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
                                <em>le <?= $data['date_com_fr']; ?></em>
                            </div>
                            <div class="commentButtonModeration">
                                <form action="index.php?action=validCom&amp;idCom=<?= $data['id_comment']; ?>" method="POST">
                                    <button class="btn btn-success" type="submit" value="valider" name="valider">Valider</button>
                                    <button class="btn btn-danger" type="submit" value="supprimer" name="supprimer">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    <?php
                    } ?>
            </div>
        </div>
    </div>
<?php else: ?>
<!-- ALerte page non autoriser -->
    <div class="alert alert-warning msgWarning" role="alert">
    <p>- Tu n'as rien a faire ici <?php echo $_SESSION['pseudo']; ?> -<br /> 
    Page non autorisée pour le commun des mortels, vous devez avoir l'autorisation du maitre des lieux !</p>
    </div>
<?php endif; ?> 
</p>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?> 
