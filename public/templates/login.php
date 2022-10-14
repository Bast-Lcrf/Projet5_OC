<?php $title = "Connexion"; ?>

<?php ob_start() ?>

<div class="login">
    <div class="form_frost">
        <h1>Formulaire de connexion</h1>
        <form action="index.php?loginUser" method="POST">
            <div class="row">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPseudo" placeholder="text" name="pseudo">
                    <label for="floatingPseudo">Pseudo</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPass" placeholder="Password" name="pwd">
                    <label for="floatingPass">Mot de passe</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-warning" type="reset" style="width: 100%;">Reset</button>
                    </div>
                    <div class="col-md-6">
                    <button class="btn btn-success" type="submit" style="width: 100%;">S'inscrire</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>