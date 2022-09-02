<?php

require_once('Model/userManager.php');
require_once('Model/postManager.php');
require_once('Model/commentManager.php');

/* -------------------- Affichage des élements -------------------- */

// Affiche la page d'accueil
    function home() 
    {
        require('View/Frontend/home.php');
    }

// Affiche la page d'inscription
    function registerPage() 
    {
        require('View/Frontend/inscription.php');
    }

// Affiche la page qui me presente
    function WhoIAm()
    {
        require('View/Frontend/whoIAm.php');
    }

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

/* -------------------- Zone ADMIN -------------------- */

// Affiche les commentaires en attente de validation dans la zone admin 
    function validView()
    {
        $validationManager = new ValidationManager();
        $validView = $validationManager->validationView();

        require('View/Frontend/zoneAdmin.php');
    }