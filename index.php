<?php

session_start();

require('src/Controller/PageController.php');
require('src/Globals/Globals.php');
require('src/Controller/UsersController.php');

use src\Globals\Globals;
use src\Controller\PageController;
use src\Controller\UsersController;
use src\Manager\ArticlesManager;


class Index 
{
    private PageController $pageController;
    private UsersController $usersController;
    private ArticlesManager $articlesManager;

    public function __construct()
    {
        $this->pageController = new PageController();
        $this->usersController = new UsersController();
        $this->articlesManager = new ArticlesManager();
    }

    public function router($get, $post) {
        try {
            if(isset($get['home'])) {
                require('public/templates/home.php');
            } elseif(isset($get['listArticles'])) {
                require('public/templates/listArticles.php');
            } elseif(isset($get['detailArticle'])) {
                if(isset($get['id']) && ($get['id'] > 0) && ($get['id'] <= $this->articlesManager->nbArticles())) {
                    $this->pageController->fullArticle(htmlspecialchars($get['id']));
                } else {
                    throw new Exception('L\'article demandé n\'existe pas');
                }
            } elseif(isset($get['deleteArticle'])) {
                $this->pageController->deleteArticle($get['id']);
            } elseif(isset($get['addNewComment'])) {
                if(!empty($post) && !empty($get)) {
                    $this->pageController->addNewCom($post['comment'], $get['id']);
                } else {
                    throw new Exception('Le commentaire ne peux etre ajouter');
                }
            } elseif(isset($get['updateCom'])) {
                if(!empty($post) && !empty($get)) {
                    $this->pageController->updateComment($post['textUpdateCom'], $get['idCom'], $get['id']);
                } else {
                    throw new Exception('Une erreur est survenue');
                }
            } elseif(isset($get['deleteComment'])) {
                $this->pageController->deleteComment($get['idCom'], $get['id']);
            } elseif(isset($get['dashboard'])) {
                $this->pageController->getDashboard();
            } elseif(isset($get['register'])) {
                require('public/templates/register.php');
            } elseif(isset($get['logIn'])) {
                require('public/templates/login.php');
            } elseif(isset($get['loginUser'])) {
                if(!empty($post)) {
                $this->usersController->authUser($post['pseudo'], $post['pwd']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            } elseif(isset($get['newUserRegister'])) {
                if(!empty($post)) {
                $this->usersController->createUserAccount(htmlspecialchars($post['pseudo']), htmlspecialchars($post['pwd']),htmlspecialchars($post['lastName']),htmlspecialchars($post['firstName']), htmlspecialchars($post['email']),htmlspecialchars($post['statut']));
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            } elseif(isset($get['logOut'])) {
                session_unset();
                session_destroy();
                header('Location: index.php');
            } elseif(isset($get['validCom'])) {
                if($post['valid']) {
                    $this->pageController->validCom($get['idCom']); // validation commentaire
                } else {
                    $this->pageController->deleteCom($get['idCom']); // suppression commentaire
                }
            }
            else {
                require('public/templates/home.php');
            }
        } catch (Exception $e) {
           echo 'Erreur :' . $e->getMessage();
        }
    }
}

$index = new Index;
$globals = new Globals;
$index->router($globals->getGET(), $globals->getPOST());