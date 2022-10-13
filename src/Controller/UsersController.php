<?php 

namespace src\Controller;

require('src/Manager/UsersManager.php');
require('src/Entity/Users.php');

use Exception;
use src\Entity\Users;
use src\Globals\Globals;
use src\Manager\UsersManager;

class UsersController 
{
    private UsersManager $userManager;
    private Globals $globals;
    private Users $user;

    public function __construct()
    {
        $this->userManager = new UsersManager;
        $this->globals = new Globals;
        $this->user = new Users;
    }

    /**
     * Identifie et connecte l'utilisateur 
     * 
     * @param string $pseudo
     * @param string $pwd
     * 
     * @return bool     true en cas de succés -> redirect vers la page d'accueil, false en cas d'erreur
     */
    public function authUser(string $pseudo, string $pwd) {
        $this->user->setPseudo($pseudo);
        $this->user->setPwd($pwd);
        $userIsOk = $this->userManager->setUser($this->user);

        if($userIsOk) {
            header('Location: index.php');
            return true;
        }
        else {
            throw new Exception('Une erreur est survenue, veuillez réessayer.');
        }
    }

    /**
     * Créer un objet Users et l'envoie a usersManager pour insertion en BDD
     * 
     * @param string $pseudo
     * @param string $pwd
     * @param string $lastName
     * @param string $firstName
     * @param string $email
     * @param string $statut
     * 
     * @return bool     true en cas de succés -> redirect vers l'accueil, false en cas d'erreur
     */
    public function createUserAccount(string $pseudo, string $pwd, string $lastName, string $firstName, string $email, string $statut) {

        $this->user->setPseudo($pseudo);
        $this->user->setPwd($pwd);
        $this->user->setLastName($lastName);
        $this->user->setFirstName($firstName);
        $this->user->setEmail($email);
        $this->user->setStatut($statut);

        $saveIsOk = $this->userManager->save($this->user);

        if($saveIsOk) {
            header('Location: index.php');
            return true;
        } else {
            throw new Exception('Erreur : Impossible de vous inscrire pour le moment');
        }
    }

}