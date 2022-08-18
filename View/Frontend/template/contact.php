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
                <div class="col-lg-6">
                    <button class="btn btn-outline-warning" type="reset" style="width: 250px">Reset</button>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-outline-success formContactButtonA" type="submit" style="width: 250px">Envoyer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if(isset($_POST['message'])) {
    $nom = $_POST['prenom'] . ' ' . $_POST['nom'];
    $retour = mail('bastlcrf.dev@gmail.com', 'Envoie depuis la page de contact', htmlspecialchars($_POST['message']), 
                htmlspecialchars($_POST['email']), $nom);
                if ($retour) {
                    echo 'Votre message a bien été envoyé.';
                }
} 