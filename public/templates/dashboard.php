<?php $title = "Admin Dashboard"; ?>

<?php ob_start() ?>

<?php if(!isset($_SESSION['pseudo'])): ?>
    <div class="alert alert-warning" role="alert">
        <p>Vous n'etes pas autorisé a entrer sur cette page.</p>
    </div>
<?php elseif($_SESSION['statut'] == 'ROLE_ADMIN'): ?>
<div class="dashboard">
    <div class="dashboard_box">
        <div class="box_moderationCom">
            <a href="">
                <div class="nbCom">
                    <p>Nombre de commentaires<br/> en attente :</p>
                    <h1><?php echo $nbComForModeration; ?></h1><br/>
                </div>
            </a>
        </div>
        <div class="box_formNewArticle">
            <a href="#writeNewPost">
                <i class='bx bxs-edit'></i>
                <h1><strong>Rédiger nouvel article</strong></h1>
            </a>
        </div>
    </div>
</div>
<div id="">
    <div class="backgroundCommentsAdmin">
        <h1>Modération des commentaires :</h1>
        <?php if($nbComForModeration <= 0): ?>
            <div class="alert alert-warning" role="alert">
                Pas de Commentaire en attente
            </div>
        <?php else: ?>
            <?php while($data = $commentForModeration->fetch()): ?>
                <div class="commentsAdmin">
                    <h2>Commentaire nº: <?php echo $data['idComment']; ?></h2>
                    <h2>Auteur : <?php echo htmlspecialchars($data['author']); ?></h2>
                    <p>Commentaire : <?php echo htmlspecialchars($data['comment']); ?></p>
                    <h3>Le : <?php echo $data['dateCommentFr']; ?></h3>
                    <h4>Commentaire pour <a target="blank" href="index.php?detailArticle&id=<?php echo $data['idArticle']; ?>">l'article </a>Nº:<?php echo $data['idArticle']; ?></h4>
                    <div class="commentButtonModeration">
                        <form action="index.php?validCom&amp;idCom=<?= $data['idComment']; ?>" method="POST">
                            <button style="width: 200px;" class="btn btn-danger" type="submit" value="supprimer" name="delete">Supprimer</button>
                            <button style="width: 200px;" class="btn btn-success" type="submit" value="valider" name="valid">Valider</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p>Vous n'etes pas autorisé <strong><?php echo $_SESSION['pseudo']; ?></strong> a entrer sur cette page.</p>
    </div>
<?php endif; ?>


<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>