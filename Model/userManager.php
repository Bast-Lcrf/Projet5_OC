<?php

require_once('Model/manager.php');

class UsersManager extends Manager
{
    // authentification des utilisateurs
    public function authUser($logPseudo, $logPass)
    {
        $db = $this->dbConnect();
        $auth = $db->prepare('SELECT id_user, pseudo, pwd, lastName, firstName, statut FROM Users WHERE pseudo = ?');
        $auth->execute(array($logPseudo));
        //$auth->rowCount();
        
        $data = $auth->fetch();

        if($logPseudo == $data['pseudo']) {
            if (password_verify($logPass, $data['pwd'])) {
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['nom'] = $data['lastName'];
                $_SESSION['prenom'] = $data['firstName'];
                $_SESSION['statut'] = $data['statut'];
                $_SESSION['id'] = $data['id_user'];
            }
            else {
                throw new Exception('Mot de passe incorrect');
            }
        }
        else {
            throw new Exception('Pseudo incorrect');
        }

        header('location: index.php'); 
    }

    // inscription utilisateurs
    public function newUser($pseudo, $passCrypt, $lastName, $firstName, $email, $statut)
    {
        $db = $this->dbConnect();
        $newUser = $db->prepare('INSERT INTO Users(pseudo, pwd, lastName, firstName, email, tagline, pictures, statut, date_signin) 
        VALUES (?, ?, ?, ?, ?, NULL, NULL, ?, NOW())');
        $affectedLine = $newUser->execute(array($pseudo, $passCrypt, $lastName, $firstName, $email, $statut));

        return $affectedLine;
    }
}