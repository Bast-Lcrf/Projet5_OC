<?php $title = "Page d'insciption"; ?>

<?php ob_start(); ?>

<div class="formInscription">
    <h3>Formulaire d'inscription</h3>
        <?php if(isset($errorMessage)): ?>
            <div class="w-50 alert alert-danger" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
            </div>
        <?php endif; ?>
                <form action="index.php?action=register" method="POST">
                    <div class="row">
                        <div class="col-lg-6 form-floating formRegister">
                            <input type="text" class="form-control" id="floatingPseudo" placeholder="text" name="pseudo" />
                            <label for="floatingPseudo">Pseudo</label>
                        </div>
                        <div class="col-lg-6 form-floating formRegister">
                            <input type="password" class="form-control" id="floatingPass" placeholder="Password" name="pwd" />
                            <label for="floatingPass">Mot de passe</label>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 form-floating formRegister">
                                <input type="text" class="form-control" id="floatingLastname" placeholder="text" name="lastName" />
                                <label for="floatingLastname" >Nom</label>
                            </div>
                            <div class="col-lg-4 form-floating formRegister">
                                <input type="text" class="form-control" id="floatingfirstname" placeholder="text" name="firstName" />
                                <label for="floatingfirstname" >Prénom</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-floating formRegister">
                                <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" />
                                <label for="floatingEmail" >E-mail</label>
                            </div>
                            <div>
                                <input type="hidden" value="2" id="statut" name="statut" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"> 
                                <button class="btn btn-outline-warning" type="reset" style="width: 100%">Reset</button>
                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-outline-success" type="submit" style="width: 100%">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>

