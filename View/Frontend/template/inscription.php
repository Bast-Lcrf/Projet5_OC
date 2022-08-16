<h3>Formulaire d'inscription</h3>

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
