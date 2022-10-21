<?php

session_start();

require('src/Controller/PageController.php');
require('src/Controller/ContactController.php');
require('src/Controller/UsersController.php');
require('src/Globals/Globals.php');

use src\Globals\Globals;
use src\Controller\ContactController;
use src\Controller\PageController;
use src\Controller\UsersController;
use src\Manager\ArticlesManager;


class Index 
{
    private ContactController $contactController;
    private PageController $pageController;
    private UsersController $usersController;
    private ArticlesManager $articlesManager;

    public function __construct()
    {
        $this->contactController = new ContactController();
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
            } elseif(isset($get['updateArticle'])) {
                if(!empty($post['updateTitleArticle']) && !empty($post['updateHeaderArticle']) && !empty($post['updateTextArticle']) && !empty($get['id'])) {
                    $this->pageController->updateArticle($post['updateTitleArticle'], $post['updateHeaderArticle'], $post['updateTextArticle'], $get['id']);
                } else {
                    throw new Exception('Tous les champs pour update l\'article ne sont pas remplis !');
                }
            } elseif(isset($get['deleteArticle'])) {
                $this->pageController->deleteArticle($get['id']);
            } elseif(isset($get['addNewComment'])) {
                if(!empty($post['comment']) && !empty($get['id'])) {
                    $this->pageController->addNewCom($post['comment'], $get['id']);
                } else {
                    throw new Exception('Le commentaire ne peux pas etre ajouter');
                }
            } elseif(isset($get['updateCom'])) {
                if(!empty($post['textUpdateCom']) && !empty($get['idCom']) && !empty($get['id'])) {
                    $this->pageController->updateComment($post['textUpdateCom'], $get['idCom'], $get['id']);
                } else {
                    throw new Exception('Veuillez remplir le champ de modification avant de valider');
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
                if(!empty($post['pseudo'] && !empty($post['pwd']))) {
                $this->usersController->authUser($post['pseudo'], $post['pwd']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            } elseif(isset($get['newUserRegister'])) {
                if(!empty($post['pseudo']) && !empty($post['pwd']) && !empty($post['lastName']) && !empty($post['firstName']) && !empty($post['email']) && !empty($post['statut'])) {
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
            } elseif(isset($get['newArticle'])) {
                if(!empty($post['title'] && !empty($post['headerPost']) && !empty($post['article']))) {
                    $this->pageController->addNewArticle($post['title'], $post['headerPost'], $post['article']);
                } else {
                    throw new Exception('Tu est admin, remplis les champs avant de valider enfin !');
                }
                
            } elseif (isset($get['contact'])) {
                if(!empty($post['lastName'] && !empty($post['firstName']) && !empty($post['email']) && !empty($post['messageContact']))) {
                    $this->contactController->getContactForm($post['lastName'], $post['firstName'], $post['email'], $post['messageContact']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis.');
                }
            }
            else {
                require('public/templates/home.php');
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require('public/templates/error.php');
        }
    }
}

$index = new Index;
$globals = new Globals;
$index->router($globals->getGET(), $globals->getPOST());