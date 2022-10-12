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

/* ---------------------------------------- Section ? ---------------------------------------- */

    /**
     * Affiche l'article complet et les commentaire associés
     */
    public function fullArticle(int $idArticle) {
        $detailArticle = $this->articleManager->readArticle($idArticle);
        $commentsDetailArticle = $this->commentsManager->readComments($idArticle);
        require('public/templates/detailArticle.php');
    }

    /**
     * Supprime un objet article via son identifiant
     * et redirige vers l'acceuil
     */
    public function deleteArticle(int $idArticle) {
        $this->articles->setIdArticle($idArticle);
        $this->articleManager->deleteArticle($this->articles);
        header('Location: index.php');
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
        $this->comments->setValidationCom(2);

        $saveIsOk = $this->commentsManager->createComment($this->comments);

        if($saveIsOk) {
            header('Location: index.php?detailArticle&id=' . $idArticle);
            return true;
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
            header('Location: index.php?detailArticle&id=' . $idArticle);
            return true;
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
            header('Location: index.php?detailArticle&id=' . $idArticle);
            return true;
        } else {
            throw new Exception('Une erreur s\'est produite, le commentaire n\'a pu etre supprimer.');
        }
    }

/* ---------------------------------------- Section Admin Dashboard ---------------------------------------- */

    /**
     * Affiche les commentaires en attente de modération sur la page dashboard réservé au admin
     */
    public function getDashboard() {
        $commentForModeration = $this->commentsManager->readCommentsModeration();
        $nbComForModeration = $this->commentsManager->nbCommentModeration();
        require('public/templates/dashboard.php');
    }

    /**
     * Valide un commentaire depuis le dashboard
     */
    public function validCom(int $idComment) {
        $this->comments->setIdComment($idComment);
        $validIsOK = $this->commentsManager->validationCom($this->comments);

        if($validIsOK) {
            header('Location: index.php?dashboard');
            return true;
        } else {
            throw new Exception('Une erreur est survenue, le commentaire n\'a pas été ajouter');
        }
    }

    /**
     * Supprime un copmmentaire depuis le dashboard
     */
    public function deleteCom(int $idComment) {
        $this->comments->setIdComment($idComment);
        $deleteIsOk = $this->commentsManager->deleteComment($this->comments);

        if($deleteIsOk) {
            header('Location: index.php?dashboard');
            return true;
        } else {
            throw new Exception('Une erreur est survenue, le commentaire n\'a pas été supprimé.');
        }
    }

    /**
     * Ajoute un nouvel article
     */
    public function addNewArticle(string $title, string $headerPost, string $article) {
        $this->articles->setIdUser($_SESSION['idUser']);
        $this->articles->setTitle($title);
        $this->articles->setAuthor($_SESSION['pseudo'] );
        $this->articles->setHeaderPost($headerPost);
        $this->articles->setArticle($article);

        $newArticleIsOk = $this->articleManager->createArticle($this->articles);

        if($newArticleIsOk) {
            header('Location: index.php?listArticles');
            return true;
        } else {
            throw new Exception('Une erreur est survenue, l\'article n\'a pas été ajouter');
        }
    }
}