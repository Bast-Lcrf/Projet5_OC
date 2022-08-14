<h4>Nous contacter</h4>
<form method="POST">
    <div>
        <label for="nom">Nom</label><br />
        <input type="text" id="nom" name="nom" />
    </div>
    <div>
        <label for="prenom">Prenom</label><br />
        <input type="text" id="prenom" name="prenom" />
    </div>
    <div>
        <label for="email">Email</label><br />
        <input type="text" id="emal" name="email" />
    </div>
    <div>
        <label for="message">Votre message</label><br />
        <textarea id="message" name="message" rows="3" cols="40"></textarea>
    </div>
    <div>
        <input type="submit" value="nous contacter" name="contact" />
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