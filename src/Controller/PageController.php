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

/* ---------------------------------------- Section Article Complet ---------------------------------------- */

    /**
     * Affiche l'article complet et les commentaire associés
     * 
     * @param int $idArticle    identifiant de l'article
     * 
     * @return bool     true en cas de succes -> la page s'affiche, false en cas d'erreur -> message d'erreur
     */
    public function fullArticle(int $idArticle) {
        $detailArticle = $this->articleManager->readArticle($idArticle);
        $commentsDetailArticle = $this->commentsManager->readComments($idArticle);

        if($detailArticle) {
            if($commentsDetailArticle) {
                require('public/templates/detailArticle.php');
                return true;
            }
        }
        else {
            throw new Exception('Une erreur est survenue, veuillez réessayer plus tard.');
        }
        
    }

    /**
     * Supprime un objet Articles via son identifiant
     * et supprime aussi les commentaires associés.
     * 
     * @param int $idArticle    identifiant de l'article
     * 
     * @return bool     true en cas de success -> affiche la page de succés, false en cas d'erreur -> message d'erreur
     */
    public function deleteArticle(int $idArticle) {
        $this->articles->setIdArticle($idArticle);
        $this->comments->setIdArticle($idArticle);
        $deleteIsOk = $this->articleManager->deleteArticle($this->articles);
        $deleteComIsOk = $this->commentsManager->deleteComFromArticle($this->comments);

        if($deleteIsOk) {
            if($deleteComIsOk) {
            $messageSuccess = 'L\'article et les commentaires ont bien été supprimés !';
            require('public/templates/success.php');
            return true;
            }
        } else {
            throw new Exception('Une erreur est survenue, l\'article n\'a pas été supprimé');
        }
    }

    /**
     * Met à jour un objet Articles via son identifiant
     * 
     * @param string $updateTitle
     * @param string $updateHeader
     * @param string $updateArticle
     * @param int $idArticle 
     * 
     * @return bool     True en cas de succés -> affiche la page de succés, false en cas d'erreur
     */
    public function updateArticle(string $updateTitle, string $updateHeader, string $updateArticle, int $idArticle) {
        $this->articles->setIdUser($_SESSION['idUser']);
        $this->articles->setTitle($updateTitle);
        $this->articles->setAuthor($_SESSION['pseudo']);
        $this->articles->setHeaderPost($updateHeader);
        $this->articles->setArticle($updateArticle);
        $this->articles->setIdArticle($idArticle);

        $updateIsOk = $this->articleManager->updateArticle($this->articles);

        if($updateIsOk) {
            $messageSuccess = 'L\'article a bien été mis à jours !';
            require('public/templates/success.php');
            return true;
        }
        else {
            throw new Exception('Une erreur est survenue, l\'article n\'pas été mis à jour, veuillez réessayer');
        }
    }

/* ---------------------------------------- Section Commentaires ---------------------------------------- */

    /**
     * création d'un objet Comments envoyer à CommentsManager pour l'insertion en BDD
     * Objet envoyer à la modération via ValidationCom
     * 
     * @param string $commentForm
     * @param int $idArticle
     * 
     * @return bool     True en cas de succés -> affiche la page de succés, false en cas d'erreur
     */
    public function addNewCom(string $commentForm, int $idArticle) {
        $this->comments->setIdUser($_SESSION['idUser']);
        $this->comments->setIdArticle($idArticle);
        $this->comments->setAuthor($_SESSION['pseudo']);
        $this->comments->setComment($commentForm);
        $this->comments->setValidationCom(2);

        $saveIsOk = $this->commentsManager->createComment($this->comments);

        if($saveIsOk) {
            $messageSuccess = 'Votre commentaire a bien été ajouté, il est en attente de modération par les admins.';
            require('public/templates/success.php');
            return true;
        } else {
            throw new Exception('Erreur: Impossible de poster un commentaire pour le moment');
        }
    }

    /**
     * Modification d'un objet commentaire
     * 
     * @param string $comment
     * @param int $idComment
     * @param int $idArticle
     * 
     * @return bool     True en cas de succés -> affiche la page de succés, false en cas d'erreur
     */
    public function updateComment(string $comment, int $idComment, int $idArticle) {
        $this->comments->setComment($comment);
        $this->comments->setIdComment($idComment);

        $updateIsOk = $this->commentsManager->updateComment($this->comments);

        if($updateIsOk) {
            $messageSuccess = 'Votre commentaire a bien été mis à jours, il est en attente de modération par les admins.';
            require('public/templates/success.php');
            return true;
        } else {
            throw new Exception('Une erreur s\'est produite, la mise à jour du commentaire n\'est pas effective, veuiller réessayer plus tard.');
        }
    }

    /**
     * Suppression d'un objet commentaire via son identifiant
     * 
     * @param int $idComment
     * @param int $idArticle
     * 
     * @return bool     true en cas de succés -> affiche la page de succés, false en cas d'erreur
     */
    public function deleteComment(int $idComment,int $idArticle) {
        $this->comments->setIdComment($idComment);
        $deleteIsOk = $this->commentsManager->deleteComment($this->comments);

        if($deleteIsOk) {
            $messageSuccess = 'Le commentaire a bien été supprimé !';
            require('public/templates/success.php');
            return true;
        } else {
            throw new Exception('Une erreur s\'est produite, le commentaire n\'a pu etre supprimer.');
        }
    }

/* ---------------------------------------- Section Admin Dashboard ---------------------------------------- */

    /**
     * Affiche les commentaires en attente de modération sur la page dashboard réservé au admin
     * 
     * @return bool     true en cas de succés, false en cas d'erreur
     */
    public function getDashboard() {
        $commentForModeration = $this->commentsManager->readCommentsModeration();
        $nbComForModeration = $this->commentsManager->nbCommentModeration();

        if($commentForModeration) {
            require('public/templates/dashboard.php');
            return true;
        }
        else {
            throw new Exception('Une erreur est survenue, veuillez réessayer.');
        }
    }

    /**
     * Valide un commentaire depuis le dashboard
     * 
     * @param int $idComment
     * 
     * @return bool     true en cas de succés -> redirect vers le dashboard, false en cas d'erreur -> affiche page d'erreur
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
     * 
     * @param int $idComment
     * 
     * @return bool     true en cas de succés -> redirect vers le dashboard, false en cas d'erreur -> affiche page d'erreur
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
     * 
     * @param string $title
     * @param string $headerPost
     * @param string $article
     * 
     * @return bool true en cas de succés -> redirect vers la liste des articles, false en cas d'erreur -> affiche page d'erreur
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