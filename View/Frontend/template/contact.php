<div class="formContact">
    <form method="POST">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingNom" placeholder="text" name="nom" />
            <label for="floatingNom">Nom</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingPrenom" placeholder="text" name="prenom" />
            <label for="floatingPrenom">Prénom</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" />
            <label for="floatingEmail">Email</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="floatingMessage" placeholder="Leave a comment here" style="height: 100px" name="message"></textarea>
            <label for="floatingMessage">Message</label>
        </div>
        <div class="formContactButton">
        <br />
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <button class="btn btn-outline-warning formContactButtonReset" type="reset" style="width: 80%">Reset</button>
                </div>
                <div class="col-md-6 col-lg-6">
                    <button class="btn btn-outline-success formContactButtonSubmit" type="submit" style="width: 80%">Envoyer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if(isset($_POST['message'])) {
    $nom = htmlspecialchars($_POST['prenom']) . ' ' . htmlspecialchars($_POST['nom']);
            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['message'])) {
                mail('bastlcrf.dev@gmail.com', 'Envoie depuis la page de contact', htmlspecialchars($_POST['message']),
                htmlspecialchars($_POST['email']), $nom);
                ?>
                <div class="alert alert-success" role="alert">
                    Votre méssage a bien été envoyé !
                </div>
                <?php
            }
            else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Tous les champs ne sont pas remplis !
                </div>
                <?php
            }
}