<?php $title = "Accueil "; ?>

<?php ob_start(); ?>

<p>
    Ce blog vous permet de suivre l'actualité de la scene compétitive de League of Legends.<br />
    Vous pouvez y retrouver les classements à jours des differentes leagues (LCS, LEC, LCK, LPL, LFL) <strong>À venir prochainement</strong>.<br />
    Vous pouvez aussi lire les articles presents sur le blog et pour commenter vous devez vous inscrire, ou vous connecter, avec les bouton si dessous.<br />
    Bonne lecture et au plaisir d'echanger avec vous !
</p>
<div class="form" >
    <?php if(!isset($_SESSION['pseudo'])): ?>
        <!-- Formulaire de connexion -->
        <h3>Formulaire de connexion :</h3>
    <?php if(isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div><br />
        <?php endif; ?>
        <form action="index.php?action=loginVerify" method="POST">
                <div>
                    <label for="pseudo">Pseudo</label><br />
                    <input type="text" id="pseudo" name="pseudo" />
                </div>
                <div>
                    <label for="pwd">Mot de passe</label><br />
                    <input type="password" id="pwd" name="pwd" />
                </div>
                <div>
                    <br />
                    <input type="submit" value="connexion" name="submit" />
                </div>
        </form>
        <br />
            <p>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                inscription 
                </button>
            </p>
            <!-- Formulaire d'inscription / collapse bootstrap --> 
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
                <?php endif; ?>
                <div style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                        <div class="card card-body" style="width: 400px;">
                            <h3>Formulaire d'inscription :</h3>
                            <form action="index.php?action=register" method="POST">
                                <div>
                                    <label for="pseudo">Pseudo</label><br />
                                    <input type="text" id="pseudo" name="pseudo" />
                                </div>
                                <div>
                                    <label for="pwd">Mot de passe</label><br />
                                    <input type="text" id="pwd" name="pwd" />
                                </div>
                                <div>
                                    <label for="lastName">Nom</label><br />
                                    <input type="text" id="lastName" name="lastName" />
                                </div>
                                <div>
                                    <label for="firstName">Prenom</label><br />
                                    <input type="text" id="firstName" name="firstName" />
                                </div>
                                <div>
                                    <label for="email">Email</label><br />
                                    <input type="text" id="email" name="email" />
                                </div>
                                <div>
                                    <input type="hidden" value="2" id="statut" name="statut" />
                                </div>
                                <div>
                                    <br />
                                    <input type="submit" value="inscription" name="inscription" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    <?php else: ?>
        <div class="alert alert-success" role="alert">
            Bonjour <?php echo $_SESSION['pseudo'];?>
        </div>
    <?php endif; ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>