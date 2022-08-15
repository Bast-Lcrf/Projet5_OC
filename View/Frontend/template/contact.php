<form method="POST">
    <div>
        <label for="nom">Nom</label><br />
        <textarea id="nom" name="nom" rows="1" cols="25"></textarea>
    </div>
    <div>
        <label for="prenom">Prenom</label><br />
        <textarea id="prenom" name="prenom" rows="1" cols="25"></textarea>
    </div>
    <div>
        <label for="email">Email</label><br />
        <textarea id="email" name="email" rows="1" cols="25"></textarea>
    </div>
    <div>
        <label for="message">Votre message</label><br />
        <textarea id="message" name="message" rows="3" cols="25"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer" name="contact" />
    </div>
</form>

<?php if(isset($_POST['message'])) {
    $nom = $_POST['prenom'] . ' ' . $_POST['nom'];
    $retour = mail('bastlcrf.dev@gmail.com', 'Envoie depuis la page de contact', htmlspecialchars($_POST['message']), 
                htmlspecialchars($_POST['email']), $nom);
                if ($retour) {
                    echo 'Votre message a bien été envoyé.';
                }
} 