<?php $title = "Inscription"; ?>

<?php ob_start() ?>

<div class="register">
    <div class="form_frost">
        <h1>Formulaire d'inscription</h1>
        <form action="index.php?newUserRegister" method="POST">
            <div class="row">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPseudo" placeholder="text" name="pseudo">
                    <label for="floatingPseudo">Pseudo</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPass" placeholder="Password" name="pwd">
                    <label for="floatingPass">Mot de passe</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingLastName" placeholder="text" name="lastName">
                    <label for="floatingLastName">Nom</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingFirstName" placeholder="text" name="firstName">
                    <label for="floatingFirstName">Prénom</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingEmail" placeholder="name@exemple.com" name="email">
                    <label for="floatingEmail">E-mail</label>
                </div>
                <div>
                    <input type="hidden" value="ROLE_USER" id="statut" name="statut">
                </div>
                <div class="btnNewRegister">
                    <button class="btn btn-warning" type="reset">Reset</button>
                    <button class="btn btn-success" type="submit">S'inscrire</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>