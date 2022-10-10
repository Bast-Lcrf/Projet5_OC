<?php

namespace src\Manager;

use PDO;
use src\Entity\Users;
use src\Manager\Manager;

class UsersManager extends Manager
{
    /**
     * Insert un objet Users dans la bdd et met à jour l'objet passé en argument en lui spécifiant un identifiant
     * 
     * 
     * @param Users $users  objet de type Users passé par reférence
     * 
     * 
     * @return bool     true si l'objet a été inséré dans la bdd, false si une erreur survient
     */
    private function create(Users &$users)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('INSERT INTO Users(pseudo, pwd, lastName, firstName, email, statut, dateSignin) 
                                                        VALUES (?, ?, ?, ?, ?, ?, NOW())');
        // hash pwd
        $cryptPass = password_hash($users->getPwd(), PASSWORD_DEFAULT, ['cost' => 12]);

        // Liaison des parameètres et éxécution de la requête
        $executeIsOk = $this->pdoStatement->execute(array($users->getPseudo(),
                                                            $cryptPass,
                                                            $users->getLastName(),
                                                            $users->getFirstName(),
                                                            $users->getEmail(),
                                                            $users->getStatut()
                                                                ));
        
        return $executeIsOk;
    }


    /**
     * Récupère un objet Users à partir de son pseudo et de son mot de passe
     * 
     * @param string $pseudo    objet de type Users
     * @param string $pwd       objet de type Users
     * 
     * @return bool|Users$_SESSION|NULL  false si une erreur survient, un objet Users si un utilisateur est trouvé,
     *                          NULL si aucune correspondance n'est trouvé.
     */
    public function setUser($pseudo, $pwd) 
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('SELECT * FROM Users WHERE pseudo = ?');
        $this->pdoStatement->execute(array($pseudo));
        $data = $this->pdoStatement->fetch();

        if($pseudo == $data['pseudo']) {
            $pass = password_verify($pwd, $data['pwd']);
            
            if($pass === false) {
                return NULL;
            }
            else {
                $_SESSION['idUser'] = $data['idUser'];
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['lastName'] = $data['lastName'];
                $_SESSION['firstName'] = $data['firstName'];
                $_SESSION['statut'] = $data['statut'];

                header('Location: index.php');
            }
        }
        else {
            return false;
        }
    }

    /*public function session($pseudo, $pwd)
    {
        $usersManager = new UsersManager;
        $sessionStart = $usersManager->setUser($pseudo, $pwd);
        
        $user = new Users;

        $user->setId($sessionStart[0]);
        $user->setPseudo($sessionStart[1]);
        $user->setLastName($sessionStart[3]);
        $user->setFirstName($sessionStart[4]);
        $user->setStatut($sessionStart[5]);
        var_dump($user);
        return $user;
    }*/


    /**
     * Récupère tous les objets Users de la bdd
     * 
     * @return array|bool   tableau d'objet Users ou tableau vide si il n'y a aucun objet dans la bdd,
     *                      false si une erreur survient
     */
    public function readAll()
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->query('SELECT * FROM Users ORDER BY idUser');

        // Construction d'un tableau d'objet de type Users

        $users = [];

        while($users = $this->pdoStatement->fetchObject('App\Entity\Users')) {
            $users[] = $users;
        }

        return $users;

    }


    /**
     * met à jours un objet Users stocké en bdd
     * 
     * @param Users $users  objet de type Users
     * 
     * @return bool     true en cas de succés, false en cas d'erreur
     */
    private function update(Users $users)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('UPDATE Users set pseudo = :pseudo, lastName = :lastName, firstName = :firstName, email = :email 
                                                    WHERE idUser = :id LIMIT 1');

        //Liaison des paramètres
        $this->pdoStatement->bindValue(':pseudo', $users->getPseudo(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':lastName', $users->getLastName(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':firstName', $users->getFirstName(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':email', $users->getEmail(), PDO::PARAM_STR);
        $this->pdoStatement->bindValue(':id', $users->getId(), PDO::PARAM_INT);

        //Éxécution de la requête
        return $this->pdoStatement->execute();

    }


    /**
     * Supprime un objet Users stocker dans la bdd
     * 
     * @param Users $users  objet de type Users
     * 
     * @return bool     true si la suppression est effective, false en cas d'erreur
     */
    public function delete(Users $users)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('DELETE FROM Users WHERE idUser = :id LIMIT 1');

        //Liaison des paramètres
        $this->pdoStatement->bindValue(':id', $users->getId(), PDO::PARAM_INT);

        //Éxécution de la requête
        return $this->pdoStatement->execute();

    }


    /**
     * Insère un objet en bdd et met à jour l'objet passé en argument en lui spécifiant un identifiant ou le met simplement à jour
     * dans la bdd si il en est issu
     * 
     * @param Users $users  objet Users passé par référence
     * 
     * @return bool     true en cas de succès, false en cas d'erreur
     */
    public function save(Users $users)
    {
        // On utiliser la methodes create lorsqu'il s'agit d'un nouvel objet 
        // et la methode update si l'objet existe déjà en bdd 
        
        if(is_null($users->getId())) {
            return $this->create($users);
        }
        else {
            return $this->update($users);
        }
    }

}