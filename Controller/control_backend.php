<?php

require_once('Model/userManager.php');
require_once('Model/postManager.php');
require_once('Model/commentManager.php');

/* --------------------  Fonctions systeme de Session  -------------------- */

// Hash des mot de passes 
function cryptedPass($pwd)
{
$passCrypt = password_hash($pwd, PASSWORD_DEFAULT, ['cost' => 12]);
    return $passCrypt;
}

// authentification des utilisateurs
function logUser($logPseudo, $logPass)
{
    $userManager = new UsersManager();
    $userManager->authUser($logPseudo, $logPass);
}

// inscription des utilisateurs
function addUser($pseudo, $passCrypt, $lastName, $firstName, $email, $statut) 
{
    $userManager = new UsersManager();
    $affectedLines = $userManager->newUser($pseudo, $passCrypt, $lastName, $firstName, $email, $statut);

    if($affectedLines == false) {
        throw new Exception('impossible de vous inscire pour le moment.');
    }
    else {
        header('location: index.php');
    }
}

/* -------------------- Fonction gestion des articles -------------------- */

// Affiche la liste des articles
function listArticles() 
{
    $postManager = new PostManager();
    $list = $postManager->getListArticle();

    require('View/Frontend/listArticles.php');
}

// Affiche le detail d'un article et ses commentaires
function detailArticle($idArticle)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $article = $postManager->getArticle($idArticle);
    $comments = $commentManager->getComments($idArticle);

    require('View/Frontend/detailArticle.php');
}

// Ajoute un nouvel article au blog 
function addArticle($idUser, $title, $author, $header_post, $article)
{
    $postManager = new PostManager();
    $newArticle = $postManager->newArticle($idUser, $title, $author, $header_post, $article);
    if($newArticle == false) {
        throw new Exception('Impossible d\'ajouter le billet');
    }
    else {
        listArticles();
    }
}

// Modifier un article
function articleUpdate($updateHeader, $updateArticle, $idArticle)
{
    $postManager = new PostManager();
    $articleUpdate = $postManager->updateArticle($updateHeader, $updateArticle, $idArticle);
}

// Supprimer un article et ses commentaires associés
function deleteArticle($idArticle)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $deleteArticle = $postManager->deleteArticle($idArticle);
    $deleteComFromArticle = $commentManager->deleteCommentFromArticle($idArticle);
}

/* -------------------- Fonction gestion des commentaires -------------------- */

// Poster un commentaire
function addComment($idUser, $idArticle, $author, $comment, $validation)
{
    $commentManager = new CommentManager();
    $affectedLine = $commentManager->postComment($idUser, $idArticle, $author, $comment, $validation);
    if($affectedLine == false) {
        throw new Exception('Impossible d\'ajouter de le commentaire.');
    }
    else {
        header('location: index.php?action=detailArticle&id=' . $idArticle);
    }
}

// Commentaire validé par la modération
function validCom($idComment)
{
    $validationManager = new ValidationManager();
    $validCom = $validationManager->updateCom($idComment);
}

// Commentaire supprimé par la modération
function deleteCom($idComDelete)
{
    $validationManager = new ValidationManager();
    $deleteCom = $validationManager->deleteCom($idComDelete);
}

// Modifier commentaire -> retour Validation 
function updateCom($com, $idCom, $idArticle)
{
    $validationManager = new ValidationManager();
    $newUpdateCom = $validationManager->modifyCom($com, $idCom);

    header('location: index.php?action=detailArticle&id=' . $idArticle);
}
