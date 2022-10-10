<?php

namespace src\Controller;

require('src/Entity/Comments.php');
require('src/Entity/Articles.php');
require('src/Manager/ArticlesManager.php');
require('src/Manager/CommentsManager.php');

use Exception;
use src\Manager\ArticlesManager;
use src\Manager\CommentsManager;
use src\Entity\Comments;
use src\Entity\Articles;

class PageController
{
    private ArticlesManager $articleManager;
    private CommentsManager $commentsManager;
    private Comments $comments;
    private Articles $articles;

    public function __construct()
    {
        $this->articleManager = new ArticlesManager;
        $this->commentsManager = new CommentsManager;
        $this->comments = new Comments;
        $this->articles = new Articles;
    }

/* ---------------------------------------- Section affichage ---------------------------------------- */

    /**
     * Affiche la page d'accueil
     */
    public function homePage() {
        return require('public/templates/home.php');
    }

    /**
     * Affiche la liste des articles
     */
    public function getListArticles() {
        return require('public/templates/listArticles.php');
    }

    /**
     * Affiche l'article complet et les commentaire associés
     */
    public function fullArticle(int $idArticle) {
        $detailArticle = $this->articleManager->readArticle($idArticle);
        $commentsDetailArticle = $this->commentsManager->readComments($idArticle);
        return require('public/templates/detailArticle.php');
    }

    /**
     * Supprime un objet article via son identifiant
     * et redirige vers l'acceuil
     */
    public function deleteArticle(int $idArticle) {
        $this->articles->setIdArticle($idArticle);
        $this->articleManager->deleteArticle($this->articles);
        return header('Location: index.php');
    }

    /**
     * Affiche la page d'inscription
     */
    public function getRegister() {
        return require('public/templates/register.php');
    }

    /**
     * Affiche la page de connexion
     */
    public function getLogin() {
        return require('public/templates/login.php');
    }

    /**
     * Affiche le dashboard admin
     */
    public function getDashboard() {
        return require('public/templates/dashboard.php');
    }

/* ---------------------------------------- Section Commentaires ---------------------------------------- */

    /**
     * création d'un objet Comments envoyer à CommentsManager pour l'insertion en BDD
     * Objet envoyer à la modération via ValidationCom
     */
    public function addNewCom(string $commentForm,int $idArticle) {
        $this->comments->setIdUser($_SESSION['idUser']);
        $this->comments->setIdArticle($idArticle);
        $this->comments->setAuthor($_SESSION['pseudo']);
        $this->comments->setComment($commentForm);
        $this->comments->setValidationCom('notValid');

        $saveIsOk = $this->commentsManager->createComment($this->comments);

        if($saveIsOk) {
            return header('Location: index.php?detailArticle&id=' . $idArticle);
        } else {
            throw new Exception('Erreur: Impossible de poster un commentaire pour le moment');
        }
    }

    /**
     * Modification d'un objet commentaire
     */
    public function updateComment(string $comment,int $idComment,int $idArticle) {
        $this->comments->setComment($comment);
        $this->comments->setIdComment($idComment);

        $updateIsOk = $this->commentsManager->updateComment($this->comments);

        if($updateIsOk) {
            return header('Location: index.php?detailArticle&id=' . $idArticle);
        } else {
            throw new Exception('Une erreur s\'est produite, la mise à jour du commentaire n\'est pas effective, veuiller réessayer plus tard.');
        }
    }

    /**
     * Suppression d'un objet commentaire via son identifiant
     */
    public function deleteComment(int $idComment,int $idArticle) {
        $this->comments->setIdComment($idComment);
        $deleteIsOk = $this->commentsManager->deleteComment($this->comments);

        if($deleteIsOk) {
            return header('Location: index.php?detailArticle&id=' . $idArticle);
        } else {
            throw new Exception('Une erreur s\'est produite, le commentaire n\'a pu etre supprimer.');
        }
    }

/* ---------------------------------------- Section Admin Dashboard ---------------------------------------- */

    /**
     * Affiche les commentaires en attente de modération sur la page dashboard réservé au admin
     */ /*
    public function getDashboard() {
        $moderationCom = $this->commentsManager->readCommentsModeration();
        require('public/templates/dashboard.php');
    } */

}