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

    public function authUser(string $pseudo, string $pwd) {
        return $this->userManager->setUser($pseudo, $pwd);
    }

    public function createUserAccount(string $pseudo, string $pwd, string $lastName, string $firstName, string $email, string $statut) {

        $this->user->setPseudo($pseudo);
        $this->user->setPwd($pwd);
        $this->user->setLastName($lastName);
        $this->user->setFirstName($firstName);
        $this->user->setEmail($email);
        $this->user->setStatut($statut);

        $saveIsOk = $this->userManager->save($this->user);

        if($saveIsOk) {
            return header('Location: index.php');
        } else {
            throw new Exception('Erreur : Impossible de vous inscrire pour le moment');
        }
    }

}