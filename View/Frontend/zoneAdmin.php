<?php $title = "Zone Administration"; ?>

<?php ob_start(); ?>

<p>
<?php if(!isset($_SESSION['pseudo'])): ?>
    <p>Page non autorisée pour le commun des mortels, vous devez avoir l'autorisation du maitre des lieux !</p>
<?php elseif($_SESSION['statut'] == 1): ?>
    <div class="container" id="admin">
        <div class="row">
            <div class="col-lg-5 formNewPost">
                <h4>Nouvel Article :</h4>
                <form action="index.php?action=newArticle" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre :</label>
                        <input type="text" class="form-control" id="title" aria-describedby="title" name="title"/>
                    </div>
                    <div class="mb-3">
                        <label for="header_post" class="form-label">Chapô :</label>
                        <input type="text" class="form-control" id="header_post" aria-describedby="header_post" name="header_post"/>
                    </div>
                    <div class="mb-3">
                        <label for="article" class="form-label">Article :</label>
                        <textarea class="form-control" id="article" name="article" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 validationCom">
                <p>Ici que je vais mettre ma validation</p>
                <?php // validView(); 
                    while($data) {
                        
                    } ?>
            </div>
        </div>
    </div>
<?php else: ?>
<!-- ALerte page non autoriser --> 
    <p>Page non autorisée pour le commun des mortels, vous devez avoir l'autorisation du maitre des lieux !</p>
<?php endif; ?> 
</p>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>
