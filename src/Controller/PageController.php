<?php

namespace src\Controller;

require('src/Entity/Comments.php');
require('src/Manager/ArticlesManager.php');
require('src/Manager/CommentsManager.php');

use Exception;
use src\Manager\ArticlesManager;
use src\Manager\CommentsManager;
use src\Entity\Comments;

class PageController
{
    private ArticlesManager $articleManager;
    private CommentsManager $commentsManager;
    private Comments $comments;

    public function __construct()
    {
        $this->articleManager = new ArticlesManager;
        $this->commentsManager = new CommentsManager;
        $this->comments = new Comments;
    }

/* ---------------------------------------- Section affichage ---------------------------------------- */

    /**
     * Affiche la page d'accueil
     */
    public function homePage() {
        require('public/templates/home.php');
    }

    /**
     * Affiche la liste des articles
     */
    public function getListArticles() {
        require('public/templates/listArticles.php');
    }

    /**
     * Affiche l'article complet et les commentaire associés
     */
    public function fullArticle($idArticle) {
        $detailArticle = $this->articleManager->readArticle($idArticle);
        $commentsDetailArticle = $this->commentsManager->readComments($idArticle);
        require('public/templates/detailArticle.php');
    }

    /**
     * Supprime un article via son identifiant
     * et redirige vers l'acceuil
     */
    public function deleteArticle($idArticle) {
        $this->articleManager->deleteArticle($idArticle);
        header('Location: index.php');
    }

    /**
     * Affiche la page d'inscription
     */
    public function getRegister() {
        require('public/templates/register.php');
    }

    /**
     * Affiche la page de connexion
     */
    public function getLogin() {
        require('public/templates/login.php');
    }

    /**
     * Affiche le dashboard admin
     */ /*
    public function getDashboard() {
        require('public/templates/dashboard.php');
    }*/

/* ---------------------------------------- Section Commentaires ---------------------------------------- */

    /**
     * création d'un objet Comments envoyer à CommentsManager pour l'insertion en BDD
     * Objet envoyer à la modération via ValidationCom
     */
    public function addNewCom($commentForm, $idArticle) {
        $this->comments->setIdUser($_SESSION['idUser']);
        $this->comments->setIdArticle($idArticle);
        $this->comments->setAuthor($_SESSION['pseudo']);
        $this->comments->setComment($commentForm);
        $this->comments->setValidationCom('notValid');

        $saveIsOk = $this->commentsManager->createComment($this->comments);

        if($saveIsOk) {
            header('Location: index.php?detailArticle&id=' . $idArticle);
        } else {
            throw new Exception('Erreur: Impossible de poster un commentaire pour le moment');
        }
    }

    /**
     * Modification d'un objet commentaire
     */
    public function updateComment($comment, $idComment, $idArticle) {
        $this->comments->setComment($comment);
        $this->comments->setIdComment($idComment);

        $updateIsOk = $this->commentsManager->updateComment($this->comments);

        if($updateIsOk) {
            header('Location: index.php?detailArticle&id=' . $idArticle);
        } else {
            throw new Exception('Une erreur s\'est produite, la mise à jour du commentaire n\'est pas effective, veuiller réessayer plus tard.');
        }
    }

    /**
     * Suppression d'un objet commentaire via son identifiant
     */
    public function deleteComment($idComment, $idArticle) {
        $this->comments->setIdComment($idComment);
        $deleteIsOk = $this->commentsManager->deleteComment($this->comments);

        if($deleteIsOk) {
            header('Location: index.php?detailArticle&id=' . $idArticle);
        } else {
            throw new Exception('Une erreur s\'est produite, le commentaire n\'a pu etre supprimer.');
        }
    }

/* ---------------------------------------- Section Admin Dashboard ---------------------------------------- */

    /**
     * Affiche les commentaires en attente de modération sur la page dashboard réservé au admin
     */
    public function getDashboard() {
        $moderationCom = $this->commentsManager->readCommentsModeration();
        require('public/templates/dashboard.php');
    }

}